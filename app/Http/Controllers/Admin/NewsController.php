<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::with(['category', 'creator'])->latest();

        // Search filter
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->has('status') && in_array($request->status, ['draft', 'published', 'archived'])) {
            $query->where('status', $request->status);
        }

        // Category filter
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Date filter
        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $news = $query->paginate(10)->withQueryString();
        $categories = NewsCategory::active()->sorted()->get();
        $stats = [
            'total' => News::count(),
            'published' => News::where('status', 'published')->count(),
            'draft' => News::where('status', 'draft')->count(),
            'archived' => News::where('status', 'archived')->count(),
        ];

        return view('admin.news.index', compact('news', 'categories', 'stats'));
    }

    public function create()
    {
        $categories = NewsCategory::active()->sorted()->get();
        return view('admin.news.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:news,slug',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category_id' => 'nullable|exists:news_categories,id',
            'featured_image' => 'nullable|image|max:2048',
            'thumbnail_image' => 'nullable|image|max:1024',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
            'author' => 'nullable|string|max:100',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
        ]);

        // Upload images
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')
                ->store('news/featured', 'public');
        }

        if ($request->hasFile('thumbnail_image')) {
            $validated['thumbnail_image'] = $request->file('thumbnail_image')
                ->store('news/thumbnails', 'public');
        }

        // Auto set published_at
        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $validated['created_by'] = Auth::id();

        News::create($validated);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'News article created successfully');
    }


    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    public function edit(News $news)
    {
        $categories = NewsCategory::active()->sorted()->get();
        return view('admin.news.edit', compact('news', 'categories'));
    }

    public function update(Request $request, News $news)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'excerpt' => 'nullable|string|max:500',
        'content' => 'required|string',
        'category_id' => 'nullable|exists:news_categories,id',
        'featured_image' => 'nullable|image|max:2048',
        'thumbnail_image' => 'nullable|image|max:1024',
        'status' => 'required|in:draft,published,archived',
        'published_at' => 'nullable|date',
        'author' => 'nullable|string|max:100',
        'meta_title' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string|max:500',
        'meta_keywords' => 'nullable|string|max:255',
        'remove_featured_image' => 'nullable|boolean',
        'remove_thumbnail_image' => 'nullable|boolean',
    ]);

    // Handle remove featured image
    if ($request->has('remove_featured_image') && $request->remove_featured_image) {
        if ($news->featured_image) {
            Storage::disk('public')->delete($news->featured_image);
            $validated['featured_image'] = null;
        }
    }

    // Handle remove thumbnail image
    if ($request->has('remove_thumbnail_image') && $request->remove_thumbnail_image) {
        if ($news->thumbnail_image) {
            Storage::disk('public')->delete($news->thumbnail_image);
            $validated['thumbnail_image'] = null;
        }
    }

    // Handle image uploads
    if ($request->hasFile('featured_image')) {
        // Delete old image
        if ($news->featured_image) {
            Storage::disk('public')->delete($news->featured_image);
        }
        $validated['featured_image'] = $request->file('featured_image')->store('news/featured', 'public');
    }

    if ($request->hasFile('thumbnail_image')) {
        // Delete old image
        if ($news->thumbnail_image) {
            Storage::disk('public')->delete($news->thumbnail_image);
        }
        $validated['thumbnail_image'] = $request->file('thumbnail_image')->store('news/thumbnails', 'public');
    }

    // Update slug if title changed
    if ($news->title !== $validated['title']) {
        $validated['slug'] = Str::slug($validated['title']);

        // Ensure unique slug
        $count = News::where('slug', $validated['slug'])->where('id', '!=', $news->id)->count();
        if ($count > 0) {
            $validated['slug'] = $validated['slug'] . '-' . ($count + 1);
        }
    }

    // Set published_at if status changed to published
    if ($validated['status'] === 'published' && empty($validated['published_at'])) {
        $validated['published_at'] = now();
    }

    $news->update($validated);

    return redirect()->route('admin.news.index')
        ->with('success', 'News article updated successfully.');
}

    public function destroy(News $news)
    {
        // Delete images
        if ($news->featured_image) {
            Storage::disk('public')->delete($news->featured_image);
        }

        if ($news->thumbnail_image) {
            Storage::disk('public')->delete($news->thumbnail_image);
        }

        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'News article deleted successfully.');
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,publish,archive,draft',
            'ids' => 'required|array',
            'ids.*' => 'exists:news,id',
        ]);

        $action = $request->action;
        $ids = $request->ids;

        switch ($action) {
            case 'delete':
                foreach ($ids as $id) {
                    $news = News::find($id);
                    if ($news->featured_image) {
                        Storage::disk('public')->delete($news->featured_image);
                    }
                    if ($news->thumbnail_image) {
                        Storage::disk('public')->delete($news->thumbnail_image);
                    }
                    $news->delete();
                }
                $message = 'Selected news articles deleted successfully.';
                break;

            case 'publish':
                News::whereIn('id', $ids)->update([
                    'status' => 'published',
                    'published_at' => now(),
                ]);
                $message = 'Selected news articles published successfully.';
                break;

            case 'archive':
                News::whereIn('id', $ids)->update(['status' => 'archived']);
                $message = 'Selected news articles archived successfully.';
                break;

            case 'draft':
                News::whereIn('id', $ids)->update(['status' => 'draft']);
                $message = 'Selected news articles moved to draft.';
                break;
        }

        return redirect()->route('admin.news.index')->with('success', $message);
    }

    public function updateStatus(Request $request, News $news)
    {
        $request->validate([
            'status' => 'required|in:draft,published,archived',
        ]);

        $news->status = $request->status;

        if ($request->status === 'published' && !$news->published_at) {
            $news->published_at = now();
        }

        $news->save();

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully.',
            'status' => $news->status,
        ]);
    }
}
