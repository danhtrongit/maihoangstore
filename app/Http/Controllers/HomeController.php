<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Certificate;
use App\Models\Client;
use App\Models\Office;
use App\Models\Post;
use App\Models\Product;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::active()->position('main_slider')->orderBy('sort_order')->get();
        $categories = Category::where('is_active', true)->whereNull('parent_id')->orderBy('sort_order')->with('children')->get();
        $featuredProducts = Product::active()->featured()->with(['category', 'brand'])->latest()->take(8)->get();
        $newProducts = Product::active()->where('is_new', true)->with(['category', 'brand'])->latest()->take(8)->get();
        $bestsellerProducts = Product::active()->where('is_bestseller', true)->with(['category', 'brand'])->latest()->take(8)->get();
        $brands = Brand::where('is_active', true)->orderBy('sort_order')->get();
        $latestPosts = Post::active()->published()->with('postCategory')->latest('published_at')->take(4)->get();
        $certificates = Certificate::active()->orderBy('sort_order')->get();
        $clients = Client::active()->orderBy('sort_order')->get();
        $services = Service::active()->featured()->orderBy('sort_order')->take(4)->get();
        $featuredProjects = Project::active()->featured()->with('projectCategory')->latest()->take(4)->get();
        $offices = Office::active()->orderBy('sort_order')->get();

        return view('home', compact(
            'banners', 'categories', 'featuredProducts', 'newProducts',
            'bestsellerProducts', 'brands', 'latestPosts',
            'certificates', 'clients', 'services', 'featuredProjects', 'offices'
        ));
    }

    public function about()
    {
        $certificates = Certificate::active()->orderBy('sort_order')->get();
        $clients = Client::active()->orderBy('sort_order')->get();
        $offices = Office::active()->orderBy('sort_order')->get();

        return view('about', compact('certificates', 'clients', 'offices'));
    }
}
