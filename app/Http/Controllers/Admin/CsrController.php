<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Csr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CsrController extends Controller
{
    /**
     * Helper function untuk memastikan directory exists
     */
    private function ensureDirectoryExists($path)
    {
        $fullPath = storage_path('app/public/'.$path);

        if (! is_dir($fullPath)) {
            mkdir($fullPath, 0755, true);
        }

        return $fullPath;
    }

    /**
     * Helper function untuk upload image dengan folder check
     */
    private function uploadImage($file, $folder, $prefix = 'csr')
    {
        if (! $file || ! $file->isValid()) {
            return null;
        }

        // Pastikan folder exists
        $this->ensureDirectoryExists($folder);

        // Generate unique filename
        $filename = $prefix.'-'.time().'-'.uniqid().'.'.$file->getClientOriginalExtension();

        // Simpan file
        $file->storeAs($folder, $filename, 'public');

        return $folder.'/'.$filename;
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
            ],
        ];

        $categories = Csr::getCategories();
        $categoryColors = [
            'social' => [
                'name' => 'Sosial',
                'color' => '#3B82F6',
                'light_color' => '#EFF6FF',
            ],
            'environment' => [
                'name' => 'Lingkungan',
                'color' => '#10B981',
                'light_color' => '#ECFDF5',
            ],
            'quality' => [
                'name' => 'Kualitas Hidup',
                'color' => '#F59E0B',
                'light_color' => '#FFFBEB',
            ],
        ];
        $availableYears = Csr::select('year')
            ->whereNotNull('year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();

        foreach ($categories as $key => &$category) {
            $category['color'] = $categoryColors[$key]['color'] ?? '#6B7280';
            $category['light_color'] = $categoryColors[$key]['light_color'] ?? '#F3F4F6';
        }

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
            'year' => 'nullable|integer|min:2000|max:'.date('Y'),
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
            DB::beginTransaction();

            /**
             * ✅ FEATURED IMAGE (S3/MinIO)
             */
            if ($request->hasFile('featured_image') && $request->file('featured_image')->isValid()) {
                $path = $request->file('featured_image')
                    ->store('csr/featured-images', 's3');
                $validated['featured_image'] = $path;
            }

            /**
             * ✅ THUMBNAIL IMAGE (S3/MinIO)
             */
            if ($request->hasFile('thumbnail_image') && $request->file('thumbnail_image')->isValid()) {
                $path = $request->file('thumbnail_image')
                    ->store('csr/thumbnail-images', 's3');
                $validated['thumbnail_image'] = $path;
            }

            /**
             * ✅ GALLERY IMAGES (S3/MinIO)
             */
            $galleryPaths = [];
            if ($request->hasFile('gallery_images')) {
                foreach ($request->file('gallery_images') as $image) {
                    if ($image->isValid()) {
                        $path = $image->store('csr/gallery-images', 's3');
                        if ($path) {
                            $galleryPaths[] = $path;
                        }
                    }
                }
                if (! empty($galleryPaths)) {
                    $validated['gallery_images'] = json_encode($galleryPaths);
                }
            }

            /**
             * ✅ IMPACT METRICS
             */
            if ($request->has('impact_metrics')) {
                $impactMetrics = [];
                foreach ($request->input('impact_metrics', []) as $metric) {
                    if (! empty($metric['name']) && ! empty($metric['value'])) {
                        $impactMetrics[] = [
                            'name' => $metric['name'],
                            'value' => $metric['value'],
                            'unit' => $metric['unit'] ?? null,
                        ];
                    }
                }
                if (! empty($impactMetrics)) {
                    $validated['impact_metrics'] = json_encode($impactMetrics);
                }
            }

            /**
             * ✅ TEAM MEMBERS
             */
            if ($request->has('team_members')) {
                $teamMembers = [];
                foreach ($request->input('team_members', []) as $member) {
                    if (! empty($member['name']) && ! empty($member['role'])) {
                        $teamMembers[] = [
                            'name' => $member['name'],
                            'role' => $member['role'],
                        ];
                    }
                }
                if (! empty($teamMembers)) {
                    $validated['team_members'] = json_encode($teamMembers);
                }
            }

            /**
             * ✅ SLUG GENERATION
             */
            $validated['slug'] = Str::slug($validated['title']);
            $count = Csr::where('slug', $validated['slug'])->count();
            if ($count > 0) {
                $validated['slug'] = $validated['slug'].'-'.($count + 1);
            }

            /**
             * ✅ PUBLISH DATE
             */
            if ($validated['status'] === 'published' && ! isset($validated['published_at'])) {
                $validated['published_at'] = now();
            }

            /**
             * ✅ DEFAULT VALUES
             */
            $validated['views'] = 0;
            $validated['likes'] = 0;
            $validated['shares'] = 0;

            if (empty($validated['sort_order'])) {
                $validated['sort_order'] = 0;
            }

            /**
             * ✅ USER INFORMATION
             */
            $validated['created_by'] = Auth::id();
            $validated['updated_by'] = Auth::id();

            /**
             * ✅ CREATE CSR PROGRAM
             */
            $csr = Csr::create($validated);

            DB::commit();

            return redirect()->route('admin.csr.index')
                ->with('success', 'CSR program "'.$validated['title'].'" created successfully!')
                ->with('created_csr_id', $csr->id);

        } catch (\Exception $e) {
            DB::rollBack();

            // Log error
            Log::error('CSR Store Error: '.$e->getMessage());
            Log::error('Trace: '.$e->getTraceAsString());

            // Clean up uploaded files jika error
            if (isset($validated['featured_image'])) {
                Storage::disk('s3')->delete($validated['featured_image']);
            }
            if (isset($validated['thumbnail_image'])) {
                Storage::disk('s3')->delete($validated['thumbnail_image']);
            }
            if (isset($galleryPaths) && is_array($galleryPaths)) {
                foreach ($galleryPaths as $path) {
                    Storage::disk('s3')->delete($path);
                }
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create CSR program: '.$e->getMessage());
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
        /**
         * ===============================
         * Categories
         * ===============================
         */
        $categories = collect(Csr::getCategories())
            ->mapWithKeys(function ($value, $key) {
                return [$key => $value['name'] ?? ucfirst($key)];
            })
            ->toArray();

        if (empty($categories)) {
            $categories = [
                'social' => ['name' => 'Social', 'color' => '#3B82F6'],
                'environment' => ['name' => 'Environment', 'color' => '#10B981'],
                'quality' => ['name' => 'Quality', 'color' => '#F59E0B'],
            ];
        }

        /**
         * ===============================
         * Years
         * ===============================
         */
        $currentYear = date('Y');
        $years = range($currentYear, 2000);

        /**
         * ===============================
         * Gallery Images (NORMALIZED)
         * Output: array of string path
         * ===============================
         */
        $galleryImages = [];

        if (! empty($csr->gallery_images)) {
            $raw = $csr->gallery_images;

            // Kalau sudah dicast array oleh model
            if (is_array($raw)) {
                $decoded = $raw;
            } else {
                // Kalau masih string JSON
                $decoded = json_decode($raw, true);
            }

            if (is_array($decoded)) {
                foreach ($decoded as $img) {
                    if (is_string($img)) {
                        $galleryImages[] = $img;
                    } elseif (is_array($img)) {
                        // Ambil path kalau ada
                        if (! empty($img['path'])) {
                            $galleryImages[] = $img['path'];
                        } else {
                            // fallback ambil value pertama
                            $first = reset($img);
                            if (is_string($first)) {
                                $galleryImages[] = $first;
                            }
                        }
                    }
                }
            }
        }

        /**
         * ===============================
         * Impact Metrics (NORMALIZED)
         * ===============================
         */
        $impactMetrics = [];

        if (! empty($csr->impact_metrics)) {
            $raw = $csr->impact_metrics;

            if (is_array($raw)) {
                $impactMetrics = $raw;
            } else {
                $decoded = json_decode($raw, true);
                $impactMetrics = is_array($decoded) ? $decoded : [];
            }
        }

        // Jika ada old input (validasi gagal)
        if (old('impact_metrics')) {
            $impactMetrics = old('impact_metrics');
        }

        /**
         * ===============================
         * Team Members (NORMALIZED)
         * ===============================
         */
        $teamMembers = [];

        if (! empty($csr->team_members)) {
            $raw = $csr->team_members;

            if (is_array($raw)) {
                $teamMembers = $raw;
            } else {
                $decoded = json_decode($raw, true);
                $teamMembers = is_array($decoded) ? $decoded : [];
            }
        }

        if (old('team_members')) {
            $teamMembers = old('team_members');
        }

        return view('admin.csr.edit', compact(
            'csr',
            'categories',
            'years',
            'galleryImages',
            'impactMetrics',
            'teamMembers'
        ));
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
            'year' => 'nullable|integer|min:2000|max:'.date('Y'),
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
        // dd($validated);

        try {
            DB::beginTransaction();

            // Simpan data gambar lama
            $oldFeaturedImage = $csr->featured_image;
            $oldThumbnailImage = $csr->thumbnail_image;
            $oldGalleryImages = $csr->gallery_images ? json_decode($csr->gallery_images, true) : [];

            /**
             * ✅ FEATURED IMAGE UPDATE (S3/MinIO)
             */
            if ($request->hasFile('featured_image') && $request->file('featured_image')->isValid()) {
                // Upload gambar baru
                $path = $request->file('featured_image')
                    ->store('csr/featured-images', 's3');
                $validated['featured_image'] = $path;

                // Hapus gambar lama dari S3
                if ($oldFeaturedImage && Storage::disk('s3')->exists($oldFeaturedImage)) {
                    Storage::disk('s3')->delete($oldFeaturedImage);
                }
            } elseif ($request->has('remove_featured_image')) {
                // Hapus gambar jika checkbox dicentang
                if ($oldFeaturedImage && Storage::disk('s3')->exists($oldFeaturedImage)) {
                    Storage::disk('s3')->delete($oldFeaturedImage);
                }
                $validated['featured_image'] = null;
            } else {
                // Tetap gunakan gambar lama
                $validated['featured_image'] = $oldFeaturedImage;
            }

            /**
             * ✅ THUMBNAIL IMAGE UPDATE (S3/MinIO)
             */
            if ($request->hasFile('thumbnail_image') && $request->file('thumbnail_image')->isValid()) {
                // Upload gambar baru
                $path = $request->file('thumbnail_image')
                    ->store('csr/thumbnail-images', 's3');
                $validated['thumbnail_image'] = $path;

                // Hapus gambar lama dari S3
                if ($oldThumbnailImage && Storage::disk('s3')->exists($oldThumbnailImage)) {
                    Storage::disk('s3')->delete($oldThumbnailImage);
                }
            } else {
                // Tetap gunakan gambar lama
                $validated['thumbnail_image'] = $oldThumbnailImage;
            }

            /**
             * ✅ GALLERY IMAGES UPDATE (S3/MinIO)
             */
            $galleryPaths = $oldGalleryImages;

            // Hapus gambar yang dipilih
            if ($request->has('remove_gallery_images')) {
                $imagesToRemove = $request->input('remove_gallery_images', []);
                foreach ($imagesToRemove as $imagePath) {
                    if ($imagePath && Storage::disk('s3')->exists($imagePath)) {
                        Storage::disk('s3')->delete($imagePath);
                    }
                    $key = array_search($imagePath, $galleryPaths);
                    if ($key !== false) {
                        unset($galleryPaths[$key]);
                    }
                }
                $galleryPaths = array_values($galleryPaths); // Reindex array
            }

            // Tambah gambar baru
            if ($request->hasFile('gallery_images')) {
                foreach ($request->file('gallery_images') as $image) {
                    if ($image->isValid()) {
                        $path = $image->store('csr/gallery-images', 's3');
                        if ($path) {
                            $galleryPaths[] = $path;
                        }
                    }
                }
            }

            if (! empty($galleryPaths)) {
                $validated['gallery_images'] = json_encode($galleryPaths);
            } else {
                $validated['gallery_images'] = null;
            }

            /**
             * ✅ IMPACT METRICS
             */
            if ($request->has('impact_metrics')) {
                $impactMetrics = [];
                foreach ($request->input('impact_metrics', []) as $metric) {
                    if (! empty($metric['name']) && ! empty($metric['value'])) {
                        $impactMetrics[] = [
                            'name' => $metric['name'],
                            'value' => $metric['value'],
                            'unit' => $metric['unit'] ?? null,
                        ];
                    }
                }
                $validated['impact_metrics'] = ! empty($impactMetrics) ? json_encode($impactMetrics) : null;
            } else {
                $validated['impact_metrics'] = null;
            }

            /**
             * ✅ TEAM MEMBERS
             */
            if ($request->has('team_members')) {
                $teamMembers = [];
                foreach ($request->input('team_members', []) as $member) {
                    if (! empty($member['name']) && ! empty($member['role'])) {
                        $teamMembers[] = [
                            'name' => $member['name'],
                            'role' => $member['role'],
                        ];
                    }
                }
                $validated['team_members'] = ! empty($teamMembers) ? json_encode($teamMembers) : null;
            } else {
                $validated['team_members'] = null;
            }

            /**
             * ✅ SLUG UPDATE (jika title berubah)
             */
            if ($csr->title !== $validated['title']) {
                $validated['slug'] = Str::slug($validated['title']);

                // Pastikan slug unik
                $count = Csr::where('slug', $validated['slug'])
                    ->where('id', '!=', $csr->id)
                    ->count();
                if ($count > 0) {
                    $validated['slug'] = $validated['slug'].'-'.($count + 1);
                }
            } else {
                $validated['slug'] = $csr->slug;
            }

            /**
             * ✅ PUBLISH DATE UPDATE
             */
            if ($validated['status'] === 'published' && $csr->status !== 'published') {
                $validated['published_at'] = now();
            } elseif ($validated['status'] !== 'published') {
                $validated['published_at'] = null;
            } else {
                $validated['published_at'] = $csr->published_at;
            }

            /**
             * ✅ UPDATE USER INFORMATION
             */
            $validated['updated_by'] = Auth::id();

            /**
             * ✅ UPDATE CSR PROGRAM
             */
            $csr->update($validated);

            DB::commit();

            return redirect()->route('admin.csr.index')
                ->with('success', 'CSR program "'.$validated['title'].'" updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack();

            // Log error
            Log::error('CSR Update Error: '.$e->getMessage());
            Log::error('Trace: '.$e->getTraceAsString());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update CSR program: '.$e->getMessage());
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
            Log::error('CSR Delete Error: '.$e->getMessage());
            Log::error('Trace: '.$e->getTraceAsString());

            return redirect()->back()
                ->with('error', 'Failed to delete CSR program: '.$e->getMessage());
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
                        'updated_by' => Auth::id(),
                    ]);
                    $message = 'Selected CSR programs published successfully.';
                    break;

                case 'archive':
                    Csr::whereIn('id', $validated['ids'])->update([
                        'status' => 'archived',
                        'updated_by' => Auth::id(),
                    ]);
                    $message = 'Selected CSR programs archived successfully.';
                    break;
            }

            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            Log::error('CSR Bulk Action Error: '.$e->getMessage());
            Log::error('Trace: '.$e->getTraceAsString());

            return redirect()->back()
                ->with('error', 'Failed to perform bulk action: '.$e->getMessage());
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
                'updated_by' => Auth::id(),
            ]);

            $statusText = $newStatus === 'published' ? 'published' : 'unpublished';

            return redirect()->back()
                ->with('success', "CSR program {$statusText} successfully.");
        } catch (\Exception $e) {
            Log::error('CSR Toggle Status Error: '.$e->getMessage());
            Log::error('Trace: '.$e->getTraceAsString());

            return redirect()->back()
                ->with('error', 'Failed to toggle status: '.$e->getMessage());
        }
    }

    /**
     * Duplicate CSR program
     */
    public function duplicate(Csr $csr)
    {
        try {
            $newCsr = $csr->replicate();
            $newCsr->title = $csr->title.' (Copy)';
            $newCsr->slug = Str::slug($newCsr->title).'-'.time();
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
                if (! empty($newGallery)) {
                    $newCsr->gallery_images = json_encode($newGallery);
                }
            }

            $newCsr->save();

            return redirect()->route('admin.csr.edit', $newCsr)
                ->with('success', 'CSR program duplicated successfully.');
        } catch (\Exception $e) {
            Log::error('CSR Duplicate Error: '.$e->getMessage());
            Log::error('Trace: '.$e->getTraceAsString());

            return redirect()->back()
                ->with('error', 'Failed to duplicate CSR program: '.$e->getMessage());
        }
    }

    /**
     * Helper untuk duplicate image file
     */
    private function duplicateImage($oldPath, $folder)
    {
        if (! $oldPath || ! Storage::disk('public')->exists($oldPath)) {
            return null;
        }

        // Pastikan folder exists
        $this->ensureDirectoryExists($folder);

        // Generate new filename
        $extension = pathinfo($oldPath, PATHINFO_EXTENSION);
        $newFilename = $folder.'/'.'csr-'.time().'-'.uniqid().'.'.$extension;

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
            Log::error('CSR Export Error: '.$e->getMessage());
            Log::error('Trace: '.$e->getTraceAsString());

            return redirect()->back()
                ->with('error', 'Failed to export data: '.$e->getMessage());
        }
    }
}
