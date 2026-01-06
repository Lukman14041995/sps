<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Csr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CsrController extends Controller
{
    /**
     * Helper function untuk memastikan directory exists
     */
    private function ensureDirectoryExists($path)
    {
        $fullPath = storage_path('app/public/' . $path);

        if (!is_dir($fullPath)) {
            mkdir($fullPath, 0755, true);
        }

        return $fullPath;
    }

    /**
     * Helper function untuk upload image dengan folder check
     */
    private function uploadImage($file, $folder, $prefix = 'csr')
    {
        if (!$file || !$file->isValid()) {
            return null;
        }

        // Pastikan folder exists
        $this->ensureDirectoryExists($folder);

        // Generate unique filename
        $filename = $prefix . '-' . time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Simpan file
        $file->storeAs($folder, $filename, 'public');

        return $folder . '/' . $filename;
    }

    /**
     * Helper function untuk delete image jika ada
     */
    private function deleteImageIfExists($path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
            return true;
        }
        return false;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $csrPrograms = Csr::latest()->paginate(12);

        $stats = [
            'total' => Csr::count(),
            'published' => Csr::published()->count(),
            'draft' => Csr::draft()->count(),
            'archived' => Csr::archived()->count(),
            'total_beneficiaries' => Csr::sum('beneficiaries_count'),
            'total_budget' => Csr::sum('budget'),
            'total_views' => Csr::sum('views'),
            'by_category' => [
                'social' => Csr::byCategory('social')->count(),
                'environment' => Csr::byCategory('environment')->count(),
                'quality' => Csr::byCategory('quality')->count(),
            ]
        ];

        $categories = Csr::getCategories();
        $availableYears = Csr::select('year')
            ->whereNotNull('year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();

        return view('admin.csr.index', compact('csrPrograms', 'stats', 'categories', 'availableYears'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Csr::getCategories();
        $currentYear = date('Y');
        $years = range($currentYear, 2000);

        return view('admin.csr.create', compact('categories', 'years'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category' => 'required|in:social,environment,quality',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:1024',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'beneficiaries_count' => 'nullable|integer|min:0',
            'budget' => 'nullable|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:2000|max:' . date('Y'),
            'duration' => 'nullable|string|max:100',
            'achievements' => 'nullable|string',
            'testimonials' => 'nullable|string',
            'partners' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published,archived',
            'sort_order' => 'nullable|integer',
        ]);

        try {
            // Handle featured image upload
            if ($request->hasFile('featured_image')) {
                $validated['featured_image'] = $this->uploadImage(
                    $request->file('featured_image'),
                    'csrs/featured',
                    'csr-featured'
                );
            }

            // Handle thumbnail image upload
            if ($request->hasFile('thumbnail_image')) {
                $validated['thumbnail_image'] = $this->uploadImage(
                    $request->file('thumbnail_image'),
                    'csrs/thumbnails',
                    'csr-thumbnail'
                );
            }

            // Handle gallery images upload
            if ($request->hasFile('gallery_images')) {
                $galleryPaths = [];
                foreach ($request->file('gallery_images') as $image) {
                    $path = $this->uploadImage($image, 'csrs/gallery', 'csr-gallery');
                    if ($path) {
                        $galleryPaths[] = $path;
                    }
                }
                if (!empty($galleryPaths)) {
                    $validated['gallery_images'] = json_encode($galleryPaths);
                }
            }

            // Handle impact metrics (dari form modal)
            if ($request->has('impact_metrics')) {
                $impactMetrics = [];
                foreach ($request->input('impact_metrics', []) as $metric) {
                    if (!empty($metric['name']) && !empty($metric['value'])) {
                        $impactMetrics[] = [
                            'name' => $metric['name'],
                            'value' => $metric['value'],
                            'unit' => $metric['unit'] ?? null,
                        ];
                    }
                }
                if (!empty($impactMetrics)) {
                    $validated['impact_metrics'] = json_encode($impactMetrics);
                }
            }

            // Handle team members (dari form modal)
            if ($request->has('team_members')) {
                $teamMembers = [];
                foreach ($request->input('team_members', []) as $member) {
                    if (!empty($member['name']) && !empty($member['role'])) {
                        $teamMembers[] = [
                            'name' => $member['name'],
                            'role' => $member['role'],
                        ];
                    }
                }
                if (!empty($teamMembers)) {
                    $validated['team_members'] = json_encode($teamMembers);
                }
            }

            // Generate slug
            $validated['slug'] = Str::slug($validated['title']);

            // Ensure unique slug
            $count = Csr::where('slug', $validated['slug'])->count();
            if ($count > 0) {
                $validated['slug'] = $validated['slug'] . '-' . ($count + 1);
            }

            // Set published_at if status is published
            if ($validated['status'] === 'published' && empty($validated['published_at'])) {
                $validated['published_at'] = now();
            }

            // Set default values
            $validated['views'] = 0;
            $validated['likes'] = 0;
            $validated['shares'] = 0;

            if (empty($validated['sort_order'])) {
                $validated['sort_order'] = 0;
            }

            // Set created_by
            $validated['created_by'] = Auth::id();
            $validated['updated_by'] = Auth::id();

            // Create the CSR program
            $csr = Csr::create($validated);

            return redirect()->route('admin.csr.index')
                ->with('success', 'CSR program "' . $validated['title'] . '" created successfully!')
                ->with('created_csr_id', $csr->id);
        } catch (\Exception $e) {
            // Log error untuk debugging
            Log::error('CSR Store Error: ' . $e->getMessage());
            Log::error('Trace: ' . $e->getTraceAsString());
            Log::error('Request Data: ', $request->all());

            // Clean up uploaded files jika error
            if (isset($validated['featured_image'])) {
                $this->deleteImageIfExists($validated['featured_image']);
            }
            if (isset($validated['thumbnail_image'])) {
                $this->deleteImageIfExists($validated['thumbnail_image']);
            }
            if (isset($galleryPaths)) {
                foreach ($galleryPaths as $path) {
                    $this->deleteImageIfExists($path);
                }
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create CSR program: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Csr $csr)
{
    $csr->load(['creator', 'updater']);

    // Decode JSON menjadi array agar aman
    $csr->impact_metrics = $csr->impact_metrics ? json_decode($csr->impact_metrics, true) : [];
    $csr->team_members = $csr->team_members ? json_decode($csr->team_members, true) : [];
    $csr->gallery_images = $csr->gallery_images ? json_decode($csr->gallery_images, true) : [];

    return view('admin.csr.show', compact('csr'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Csr $csr)
    {
        $categories = collect(Csr::getCategories())->mapWithKeys(function ($value, $key) {
    return [$key => $value['name'] ?? ucfirst($key)];
})->toArray();

        $currentYear = date('Y');
        $years = range($currentYear, 2000);

        return view('admin.csr.edit', compact('csr', 'categories', 'years'));
    }

   
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Csr $csr)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category' => 'required|in:social,environment,quality',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:1024',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'beneficiaries_count' => 'nullable|integer|min:0',
            'budget' => 'nullable|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:2000|max:' . date('Y'),
            'duration' => 'nullable|string|max:100',
            'achievements' => 'nullable|string',
            'testimonials' => 'nullable|string',
            'partners' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published,archived',
            'sort_order' => 'nullable|integer',
        ]);

        try {
            // Handle featured image upload
            if ($request->hasFile('featured_image')) {
                // Delete old image
                $this->deleteImageIfExists($csr->featured_image);

                // Upload new image
                $validated['featured_image'] = $this->uploadImage(
                    $request->file('featured_image'),
                    'csrs/featured',
                    'csr-featured'
                );
            } else {
                // Keep old image
                unset($validated['featured_image']);
            }

            // Handle thumbnail image upload
            if ($request->hasFile('thumbnail_image')) {
                // Delete old image
                $this->deleteImageIfExists($csr->thumbnail_image);

                // Upload new image
                $validated['thumbnail_image'] = $this->uploadImage(
                    $request->file('thumbnail_image'),
                    'csrs/thumbnails',
                    'csr-thumbnail'
                );
            } else {
                // Keep old image
                unset($validated['thumbnail_image']);
            }

            // Handle gallery images upload
            if ($request->hasFile('gallery_images')) {
                // Delete old gallery images
                if ($csr->gallery_images) {
                    $oldGallery = json_decode($csr->gallery_images, true);
                    foreach ($oldGallery as $oldImage) {
                        $this->deleteImageIfExists($oldImage);
                    }
                }

                // Upload new gallery images
                $galleryPaths = [];
                foreach ($request->file('gallery_images') as $image) {
                    $path = $this->uploadImage($image, 'csrs/gallery', 'csr-gallery');
                    if ($path) {
                        $galleryPaths[] = $path;
                    }
                }
                if (!empty($galleryPaths)) {
                    $validated['gallery_images'] = json_encode($galleryPaths);
                }
            } elseif ($request->has('keep_gallery_images')) {
                // Keep existing gallery images
                $validated['gallery_images'] = $csr->gallery_images;
            }

            // Handle impact metrics
            if ($request->has('impact_metrics')) {
                $impactMetrics = [];
                foreach ($request->input('impact_metrics', []) as $metric) {
                    if (!empty($metric['name']) && !empty($metric['value'])) {
                        $impactMetrics[] = [
                            'name' => $metric['name'],
                            'value' => $metric['value'],
                            'unit' => $metric['unit'] ?? null,
                        ];
                    }
                }
                $validated['impact_metrics'] = !empty($impactMetrics) ? json_encode($impactMetrics) : null;
            }

            // Handle team members
            if ($request->has('team_members')) {
                $teamMembers = [];
                foreach ($request->input('team_members', []) as $member) {
                    if (!empty($member['name']) && !empty($member['role'])) {
                        $teamMembers[] = [
                            'name' => $member['name'],
                            'role' => $member['role'],
                        ];
                    }
                }
                $validated['team_members'] = !empty($teamMembers) ? json_encode($teamMembers) : null;
            }

            // Generate slug if title changed
            if ($csr->title !== $validated['title']) {
                $validated['slug'] = Str::slug($validated['title']);

                // Ensure unique slug
                $count = Csr::where('slug', $validated['slug'])
                    ->where('id', '!=', $csr->id)
                    ->count();

                if ($count > 0) {
                    $validated['slug'] = $validated['slug'] . '-' . ($count + 1);
                }
            }

            // Set published_at if status changed to published
            if ($validated['status'] === 'published' && $csr->status !== 'published') {
                $validated['published_at'] = now();
            }

            // Set updated_by
            $validated['updated_by'] = Auth::id();

            // Update CSR
            $csr->update($validated);

            return redirect()->route('admin.csr.index')
                ->with('success', 'CSR program updated successfully.');
        } catch (\Exception $e) {
            // Log error
            Log::error('CSR Update Error: ' . $e->getMessage());
            Log::error('Trace: ' . $e->getTraceAsString());
            Log::error('Request Data: ', $request->all());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update CSR program: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Csr $csr)
    {
        try {
            // Delete images
            $this->deleteImageIfExists($csr->featured_image);
            $this->deleteImageIfExists($csr->thumbnail_image);

            // Delete gallery images
            if ($csr->gallery_images) {
                $gallery = json_decode($csr->gallery_images, true);
                foreach ($gallery as $image) {
                    $this->deleteImageIfExists($image);
                }
            }

            // Delete the CSR
            $csr->delete();

            return redirect()->route('admin.csr.index')
                ->with('success', 'CSR program deleted successfully.');
        } catch (\Exception $e) {
            Log::error('CSR Delete Error: ' . $e->getMessage());
            Log::error('Trace: ' . $e->getTraceAsString());

            return redirect()->back()
                ->with('error', 'Failed to delete CSR program: ' . $e->getMessage());
        }
    }

    /**
     * Bulk actions for CSR programs
     */
    public function bulkAction(Request $request)
    {
        $validated = $request->validate([
            'action' => 'required|in:delete,publish,archive',
            'ids' => 'required|array',
            'ids.*' => 'exists:csrs,id',
        ]);

        try {
            switch ($validated['action']) {
                case 'delete':
                    Csr::whereIn('id', $validated['ids'])->each(function ($csr) {
                        // Delete images
                        $this->deleteImageIfExists($csr->featured_image);
                        $this->deleteImageIfExists($csr->thumbnail_image);

                        // Delete gallery images
                        if ($csr->gallery_images) {
                            $gallery = json_decode($csr->gallery_images, true);
                            foreach ($gallery as $image) {
                                $this->deleteImageIfExists($image);
                            }
                        }

                        $csr->delete();
                    });
                    $message = 'Selected CSR programs deleted successfully.';
                    break;

                case 'publish':
                    Csr::whereIn('id', $validated['ids'])->update([
                        'status' => 'published',
                        'published_at' => now(),
                        'updated_by' => Auth::id()
                    ]);
                    $message = 'Selected CSR programs published successfully.';
                    break;

                case 'archive':
                    Csr::whereIn('id', $validated['ids'])->update([
                        'status' => 'archived',
                        'updated_by' => Auth::id()
                    ]);
                    $message = 'Selected CSR programs archived successfully.';
                    break;
            }

            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            Log::error('CSR Bulk Action Error: ' . $e->getMessage());
            Log::error('Trace: ' . $e->getTraceAsString());

            return redirect()->back()
                ->with('error', 'Failed to perform bulk action: ' . $e->getMessage());
        }
    }

    /**
     * Toggle CSR status
     */
    public function toggleStatus(Csr $csr)
    {
        try {
            $newStatus = $csr->status === 'published' ? 'draft' : 'published';

            $csr->update([
                'status' => $newStatus,
                'published_at' => $newStatus === 'published' ? now() : $csr->published_at,
                'updated_by' => Auth::id()
            ]);

            $statusText = $newStatus === 'published' ? 'published' : 'unpublished';

            return redirect()->back()
                ->with('success', "CSR program {$statusText} successfully.");
        } catch (\Exception $e) {
            Log::error('CSR Toggle Status Error: ' . $e->getMessage());
            Log::error('Trace: ' . $e->getTraceAsString());

            return redirect()->back()
                ->with('error', 'Failed to toggle status: ' . $e->getMessage());
        }
    }

    /**
     * Duplicate CSR program
     */
    public function duplicate(Csr $csr)
    {
        try {
            $newCsr = $csr->replicate();
            $newCsr->title = $csr->title . ' (Copy)';
            $newCsr->slug = Str::slug($newCsr->title) . '-' . time();
            $newCsr->status = 'draft';
            $newCsr->published_at = null;
            $newCsr->views = 0;
            $newCsr->likes = 0;
            $newCsr->shares = 0;
            $newCsr->created_by = Auth::id();
            $newCsr->updated_by = Auth::id();
            $newCsr->created_at = now();
            $newCsr->updated_at = now();

            // Jika ada images, kita perlu copy file-nya
            if ($csr->featured_image) {
                $newPath = $this->duplicateImage($csr->featured_image, 'csrs/featured');
                if ($newPath) {
                    $newCsr->featured_image = $newPath;
                }
            }

            if ($csr->thumbnail_image) {
                $newPath = $this->duplicateImage($csr->thumbnail_image, 'csrs/thumbnails');
                if ($newPath) {
                    $newCsr->thumbnail_image = $newPath;
                }
            }

            // Duplicate gallery images
            if ($csr->gallery_images) {
                $oldGallery = json_decode($csr->gallery_images, true);
                $newGallery = [];
                foreach ($oldGallery as $image) {
                    $newPath = $this->duplicateImage($image, 'csrs/gallery');
                    if ($newPath) {
                        $newGallery[] = $newPath;
                    }
                }
                if (!empty($newGallery)) {
                    $newCsr->gallery_images = json_encode($newGallery);
                }
            }

            $newCsr->save();

            return redirect()->route('admin.csr.edit', $newCsr)
                ->with('success', 'CSR program duplicated successfully.');
        } catch (\Exception $e) {
            Log::error('CSR Duplicate Error: ' . $e->getMessage());
            Log::error('Trace: ' . $e->getTraceAsString());

            return redirect()->back()
                ->with('error', 'Failed to duplicate CSR program: ' . $e->getMessage());
        }
    }

    /**
     * Helper untuk duplicate image file
     */
    private function duplicateImage($oldPath, $folder)
    {
        if (!$oldPath || !Storage::disk('public')->exists($oldPath)) {
            return null;
        }

        // Pastikan folder exists
        $this->ensureDirectoryExists($folder);

        // Generate new filename
        $extension = pathinfo($oldPath, PATHINFO_EXTENSION);
        $newFilename = $folder . '/' . 'csr-' . time() . '-' . uniqid() . '.' . $extension;

        // Copy file
        Storage::disk('public')->copy($oldPath, $newFilename);

        return $newFilename;
    }

    /**
     * Export CSR data (contoh sederhana)
     */
    public function export(Request $request)
    {
        try {
            $csrs = Csr::all();

            $data = $csrs->map(function ($csr) {
                return [
                    'ID' => $csr->id,
                    'Title' => $csr->title,
                    'Category' => $csr->category_name,
                    'Status' => ucfirst($csr->status),
                    'Location' => $csr->location,
                    'Year' => $csr->year,
                    'Beneficiaries' => $csr->beneficiaries_count,
                    'Budget' => $csr->budget,
                    'Duration' => $csr->duration,
                    'Created At' => $csr->created_at->format('Y-m-d H:i:s'),
                    'Updated At' => $csr->updated_at->format('Y-m-d H:i:s'),
                ];
            });

            // Untuk sekarang kita hanya return view
            // Di production bisa implement CSV atau Excel export

            return view('admin.csr.export', compact('data'))
                ->with('success', 'Data ready for export.');
        } catch (\Exception $e) {
            Log::error('CSR Export Error: ' . $e->getMessage());
            Log::error('Trace: ' . $e->getTraceAsString());

            return redirect()->back()
                ->with('error', 'Failed to export data: ' . $e->getMessage());
        }
    }
}
