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
            'featured_image' => 'nullable|image|max:2048|mimes:jpeg,png,jpg,gif,webp',
            'thumbnail_image' => 'nullable|image|max:1024|mimes:jpeg,png,jpg,gif,webp',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
            'author' => 'nullable|string|max:100',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
        ]);

        try {
            // ✅ Upload images to MinIO (S3) with better error handling
            if ($request->hasFile('featured_image') && $request->file('featured_image')->isValid()) {
                $path = $request->file('featured_image')
                    ->store('news/featured', 's3');

                // Pastikan path disimpan dengan benar
                $validated['featured_image'] = $path;
            }

            if ($request->hasFile('thumbnail_image') && $request->file('thumbnail_image')->isValid()) {
                $path = $request->file('thumbnail_image')
                    ->store('news/thumbnails', 's3');

                $validated['thumbnail_image'] = $path;
            }

            // Auto set published_at if status is published
            if ($validated['status'] === 'published' && empty($validated['published_at'])) {
                $validated['published_at'] = now();
            }

            // Auto-generate author jika kosong
            if (empty($validated['author'])) {
                $validated['author'] = Auth::user()->name ?? 'Admin';
            }

            $validated['created_by'] = Auth::id();

            News::create($validated);

            return redirect()
                ->route('admin.news.index')
                ->with('success', 'News article created successfully!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to create article. Error: '.$e->getMessage());
        }
    }

    // Di NewsController.php
    public function generateSlug(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $slug = Str::slug($request->title);

        // Check if slug exists
        $count = News::where('slug', 'like', $slug.'%')->count();

        if ($count > 0) {
            $slug = $slug.'-'.($count + 1);
        }

        return response()->json([
            'slug' => $slug,
        ]);
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

        // ✅ Remove featured image (MinIO)
        if ($request->boolean('remove_featured_image')) {
            if ($news->featured_image && Storage::disk('s3')->exists($news->featured_image)) {
                Storage::disk('s3')->delete($news->featured_image);
            }
            $validated['featured_image'] = null;
        }

        // ✅ Remove thumbnail image (MinIO)
        if ($request->boolean('remove_thumbnail_image')) {
            if ($news->thumbnail_image && Storage::disk('s3')->exists($news->thumbnail_image)) {
                Storage::disk('s3')->delete($news->thumbnail_image);
            }
            $validated['thumbnail_image'] = null;
        }

        // ✅ Upload featured image
        if ($request->hasFile('featured_image')) {
            if ($news->featured_image && Storage::disk('s3')->exists($news->featured_image)) {
                Storage::disk('s3')->delete($news->featured_image);
            }

            $validated['featured_image'] = $request->file('featured_image')
                ->store('news/featured', 's3');
        }

        // ✅ Upload thumbnail image
        if ($request->hasFile('thumbnail_image')) {
            if ($news->thumbnail_image && Storage::disk('s3')->exists($news->thumbnail_image)) {
                Storage::disk('s3')->delete($news->thumbnail_image);
            }

            $validated['thumbnail_image'] = $request->file('thumbnail_image')
                ->store('news/thumbnails', 's3');
        }

        // Update slug if title changed
        if ($news->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']);

            $count = News::where('slug', $validated['slug'])
                ->where('id', '!=', $news->id)
                ->count();

            if ($count > 0) {
                $validated['slug'] .= '-'.($count + 1);
            }
        }

        // Auto published_at
        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $news->update($validated);

        return redirect()
            ->route('admin.news.index')
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
            'action' => 'required|in:publish,draft,archive,delete',
            'ids' => 'required|array',
            'ids.*' => 'exists:news,id',
        ]);

        try {
            $ids = $request->ids;
            $action = $request->action;

            switch ($action) {
                case 'publish':
                    News::whereIn('id', $ids)->update([
                        'status' => 'published',
                        'published_at' => now(),
                    ]);
                    $message = 'Selected articles have been published';
                    break;

                case 'draft':
                    News::whereIn('id', $ids)->update(['status' => 'draft']);
                    $message = 'Selected articles have been moved to draft';
                    break;

                case 'archive':
                    News::whereIn('id', $ids)->update(['status' => 'archived']);
                    $message = 'Selected articles have been archived';
                    break;

                case 'delete':
                    $articles = News::whereIn('id', $ids)->get();
                    foreach ($articles as $article) {
                        // Delete images from storage
                        if ($article->featured_image) {
                            Storage::disk('s3')->delete($article->featured_image);
                        }
                        if ($article->thumbnail_image) {
                            Storage::disk('s3')->delete($article->thumbnail_image);
                        }
                        $article->delete();
                    }
                    $message = 'Selected articles have been deleted';
                    break;

                default:
                    return redirect()->back()->with('error', 'Invalid action');
            }

            return redirect()->back()->with('success', $message);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to perform bulk action: '.$e->getMessage());
        }
    }

    public function updateStatus(Request $request, News $news)
    {
        $request->validate([
            'status' => 'required|in:draft,published,archived'
        ]);

        try {
            $oldStatus = $news->status;
            $newStatus = $request->status;

            $news->status = $newStatus;
            
            // If publishing and no published_at date, set it
            if ($newStatus === 'published' && !$news->published_at) {
                $news->published_at = now();
            }
            
            $news->save();

            return response()->json([
                'success' => true,
                'message' => 'Status updated successfully',
                'data' => [
                    'old_status' => $oldStatus,
                    'new_status' => $newStatus
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update status: ' . $e->getMessage()
            ], 500);
        }
    }

}
