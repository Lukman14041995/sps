<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Csr;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        // Query dasar (kalau mau dipakai lagi nanti)
        $query = News::with(['category'])
            ->withTrashed()
            ->where('status', 'published')
            ->where(function ($q) {
                $q->whereNull('deleted_at')
                    ->orWhere('deleted_at', '>=', now()->subDays(30));
            });

        // Latest 3 News
        $latestNews = (clone $query)
            ->latest('published_at')
            ->limit(3)
            ->get();

        return view('pages.home', compact('latestNews'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function business()
    {
        return view('pages.business-units');
    }

    public function news(Request $request)
    {
        // Query dasar
        $query = News::with(['category'])
            ->withTrashed()
            ->where('status', 'published')
            ->where(function ($q) {
                $q->whereNull('deleted_at')
                    ->orWhere('deleted_at', '>=', now()->subDays(30));
            });

        // === SEARCH ===
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // === CATEGORY ===
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // === DATE FILTER ===
        if ($request->filled('date_from')) {
            $query->whereDate('published_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('published_at', '<=', $request->date_to);
        }

        // Featured News
        $featuredNews = (clone $query)->latest('published_at')->first();

        // Latest 3 News
        $latestNews = News::with('category')
            ->where('status', 'published')
            ->latest('published_at')
            ->limit(3)
            ->get();

        // All News dengan pagination
        $allNews = $query->latest('published_at')
            ->paginate(12)
            ->withQueryString();

        // Categories untuk filter
        $categories = NewsCategory::active()->sorted()->get();

        return view('pages.news', compact(
            'latestNews',
            'featuredNews',
            'allNews',
            'categories'
        ));
    }

    public function showNews($slug)
    {
        // Cari berita berdasarkan slug
        $news = News::where('slug', $slug)
            ->firstOrFail();

        // Increment views
        $news->increment('views');

        // Get related news
        $relatedNews = News::where('category_id', $news->category_id)
            ->where('id', '!=', $news->id)
            ->latest()
            ->take(3)
            ->get();

        // Get latest news for sidebar
        $latestNews = News::where('id', '!=', $news->id)
            ->latest()
            ->take(5)
            ->get();

        return view('pages.news.shows', compact('news', 'relatedNews', 'latestNews'));
    }

    public function career()
    {
        // Ambil semua lowongan yang aktif
        $jobListings = Career::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();

        // Ambil unique departments untuk filter
        $departments = Career::where('is_active', true)
            ->select('department')
            ->distinct()
            ->orderBy('department')
            ->pluck('department');

        return view('pages.career', compact('jobListings', 'departments'));
    }

    public function careerDetail($id)
    {
        $job = Career::where('is_active', true)->findOrFail($id);

        // Get related jobs (same department)
        $relatedJobs = Career::where('is_active', true)
            ->where('department', $job->department)
            ->where('id', '!=', $job->id)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view('pages.career-detail', compact('job', 'relatedJobs'));
    }

    public function csr()
    {
        // Ambil hanya CSR yang published
        $csrPrograms = Csr::published()
            // ->with('media') // jika menggunakan media library
            ->latest()
            ->paginate(9);

        $categories = Csr::getCategories();
        $years = Csr::select('year')
            ->whereNotNull('year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');
        //  dd($csrPrograms);

        return view('pages.csr', compact('csrPrograms', 'categories', 'years'));
    }

    public function csrShow($slug)
    {
        $csr = Csr::published()
            ->where('slug', $slug)
            ->firstOrFail();

        // Increment views
        $csr->increment('views');

        // Get related CSR programs
        $relatedCsr = Csr::published()
            ->where('id', '!=', $csr->id)
            ->where('category', $csr->category)
            ->limit(3)
            ->get();

        return view('pages.csr-show', compact('csr', 'relatedCsr'));
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
