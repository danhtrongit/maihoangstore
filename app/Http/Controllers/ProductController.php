<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::active()->with(['category', 'brand']);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('brand')) {
            $query->where('brand_id', $request->brand);
        }
        if ($request->filled('sort')) {
            match ($request->sort) {
                'price_asc' => $query->orderByRaw('COALESCE(sale_price, price) ASC'),
                'price_desc' => $query->orderByRaw('COALESCE(sale_price, price) DESC'),
                'newest' => $query->latest(),
                'name' => $query->orderBy('name'),
                default => $query->latest(),
            };
        } else {
            $query->latest();
        }

        $products = $query->paginate(12);
        $brands = Brand::where('is_active', true)->orderBy('sort_order')->get();
        $categories = Category::where('is_active', true)->whereNull('parent_id')->orderBy('sort_order')->with('children')->get();

        return view('products.index', compact('products', 'brands', 'categories'));
    }

    public function show(Product $product)
    {
        $product->load(['category', 'brand', 'attributes', 'images']);
        $relatedProducts = Product::active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }

    public function promotions(Request $request)
    {
        $query = Product::active()->whereNotNull('sale_price')->where('sale_price', '>', 0)->with(['category', 'brand']);

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
        $categories = Category::where('is_active', true)->whereNull('parent_id')->orderBy('sort_order')->with('children')->get();

        return view('promotions', compact('products', 'categories'));
    }
}
