<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
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
        ->where(function($q) {
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

    public function career()
    {
        return view('pages.career');
    }
    public function csr()
    {
        return view('pages.csr');
    }
    public function contact()
    {
        return view('pages.contact');
    }
}
