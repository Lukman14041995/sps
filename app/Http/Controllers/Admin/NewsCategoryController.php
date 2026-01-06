<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class NewsCategoryController extends Controller
{
    // public function index()
    // {
    //     // Gunakan paginate() bukan get()
    //     $categories = NewsCategory::orderBy('order')
    //         ->orderBy('created_at', 'desc')
    //         ->paginate(10); // 10 item per halaman

    //     // Hitung stats untuk cards (masih butuh semua data untuk stats)
    //     $allCategories = NewsCategory::all();
    //     $totalCategories = $allCategories->count();
    //     $activeCategories = $allCategories->where('is_active', true)->count();
    //     $inactiveCategories = $totalCategories - $activeCategories;
    //     $lastAdded = $allCategories->isNotEmpty() ? $allCategories->first()->created_at->diffForHumans() : '-';

    //     return view('admin.news-categories.index', compact(
    //         'categories',
    //         'totalCategories',
    //         'activeCategories',
    //         'inactiveCategories',
    //         'lastAdded'
    //     ));
    // }
    public function index()
    {
        $categories = NewsCategory::orderBy('order')
            ->orderBy('created_at', 'desc')
            ->get(); // 

        $totalCategories = $categories->count();
        $activeCategories = $categories->where('is_active', true)->count();
        $inactiveCategories = $totalCategories - $activeCategories;
        $lastAdded = $categories->isNotEmpty() ? $categories->first()->created_at->diffForHumans() : '-';

        return view('admin.news-categories.index', compact(
            'categories',
            'totalCategories',
            'activeCategories',
            'inactiveCategories',
            'lastAdded'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:news_categories,name',
            'slug' => 'required|string|max:255|unique:news_categories,slug',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'required|boolean',
        ]);

        try {
            NewsCategory::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Category created successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create category: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'orders' => 'required|array',
            'orders.*.id' => 'required|exists:news_categories,id',
            'orders.*.order' => 'required|integer|min:0'
        ]);

        try {
            foreach ($request->orders as $item) {
                NewsCategory::where('id', $item['id'])->update(['order' => $item['order']]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Order updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update order: ' . $e->getMessage()
            ], 500);
        }
    }

    // public function updateInline(Request $request)
    // {
    //     $request->validate([
    //         'id' => 'required|exists:news_categories,id',
    //         'field' => 'required|in:name,slug,description,order',
    //         'value' => 'required'
    //     ]);

    //     try {
    //         $category = NewsCategory::findOrFail($request->id);

    //         // Special handling for different fields
    //         if ($request->field === 'slug') {
    //             $request->validate([
    //                 'value' => 'required|string|max:255|unique:news_categories,slug,' . $category->id
    //             ]);
    //         } elseif ($request->field === 'name') {
    //             $request->validate([
    //                 'value' => 'required|string|max:255|unique:news_categories,name,' . $category->id
    //             ]);
    //         } elseif ($request->field === 'order') {
    //             $request->validate([
    //                 'value' => 'required|integer|min:0'
    //             ]);
    //         }

    //         $category->{$request->field} = $request->value;
    //         $category->save();

    //         return response()->json([
    //             'success' => true,
    //             'message' => ucfirst($request->field) . ' updated successfully'
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Failed to update: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function updateInline(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:news_categories,id',
            'field' => 'required|in:name,slug,description,order',
            'value' => 'required'
        ]);

        try {
            $category = NewsCategory::findOrFail($request->id);

            // Special handling for different fields
            if ($request->field === 'slug') {
                $request->validate([
                    'value' => 'required|string|max:255|unique:news_categories,slug,' . $category->id
                ]);
            } elseif ($request->field === 'name') {
                $request->validate([
                    'value' => 'required|string|max:255|unique:news_categories,name,' . $category->id
                ]);
                // Auto-generate slug from name
                $category->slug = Str::slug($request->value);
            } elseif ($request->field === 'order') {
                $request->validate([
                    'value' => 'required|integer|min:0'
                ]);
            }

            $category->{$request->field} = $request->field === 'order' ? (int)$request->value : $request->value;
            $category->save();

            return response()->json([
                'success' => true,
                'message' => ucfirst($request->field) . ' updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update: ' . $e->getMessage()
            ], 500);
        }
    }

    public function toggleStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:news_categories,id',
            'is_active' => 'required|boolean'
        ]);

        try {
            $category = NewsCategory::findOrFail($request->id);
            $category->is_active = $request->is_active;
            $category->save();

            return response()->json([
                'success' => true,
                'message' => 'Status updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update status: ' . $e->getMessage()
            ], 500);
        }
    }

    public function stats()
    {
        $totalCategories = NewsCategory::count();
        $activeCategories = NewsCategory::where('is_active', true)->count();
        $inactiveCategories = $totalCategories - $activeCategories;
        $lastAdded = NewsCategory::latest()->first();

        return response()->json([
            'success' => true,
            'total' => $totalCategories,
            'active' => $activeCategories,
            'inactive' => $inactiveCategories,
            'last_added' => $lastAdded ? $lastAdded->created_at->diffForHumans() : '-'
        ]);
    }

    public function destroy($id)
    {
        try {
            $category = NewsCategory::findOrFail($id);

            // Check if category has news articles
            if ($category->news()->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot delete category with existing news articles'
                ], 400);
            }

            $category->delete();

            return response()->json([
                'success' => true,
                'message' => 'Category deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete category: ' . $e->getMessage()
            ], 500);
        }
    }
}
