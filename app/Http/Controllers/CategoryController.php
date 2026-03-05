<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category, Request $request)
    {
        $query = Product::active()->with(['category', 'brand']);

        $categoryIds = $category->descendants()->pluck('id')->push($category->id);
        $query->whereIn('category_id', $categoryIds);

        if ($request->filled('brand')) {
            $query->where('brand_id', $request->brand);
        }
        if ($request->filled('sort')) {
            match ($request->sort) {
                'price_asc' => $query->orderByRaw('COALESCE(sale_price, price) ASC'),
                'price_desc' => $query->orderByRaw('COALESCE(sale_price, price) DESC'),
                'newest' => $query->latest(),
                default => $query->latest(),
            };
        } else {
            $query->latest();
        }

        $products = $query->paginate(12);
        $brands = Brand::where('is_active', true)->orderBy('sort_order')->get();
        $subcategories = $category->children()->where('is_active', true)->orderBy('sort_order')->get();

        return view('categories.show', compact('category', 'products', 'brands', 'subcategories'));
    }
}
