<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    // public function getArchiveProducts()
    // {
    //     $products = Product::with('category')
    //         ->where('publish_status', 'En vitrina')
    //         ->paginate(10); 

    //     return response()->json($products);
    // }

    public function getArchiveProducts()
    {
        $category_id = request()->input('category_id');
        $genre = request()->input('genre');
        $min_price = request()->input('min_price');
        $max_price = request()->input('max_price');

        $products = Product::with('category')
            ->where('publish_status', 'En vitrina')
            ->withFilters($category_id, $genre, $min_price, $max_price)
            ->paginate(10); 

        return response()->json($products);
    }

    // public function getArchiveCategories()
    // {
    //     $categories = Category::with('children')->whereNull('parent_id')->get();

    //     return response()->json(['categories' => $categories]);
    // }

    public function getArchiveCategories()
    {
        $category_id = request()->input('category_id');
        $genre = request()->input('genre');
        $min_price = request()->input('min_price');
        $max_price = request()->input('max_price');

        $categories = Category::with(['children','product' => function ($query) use ($category_id, $genre, $min_price, $max_price) {
            $query->withFilters($category_id, $genre, $min_price, $max_price);
        }])
        ->whereNull('parent_id')
        ->get();

        return response()->json(['categories' => $categories]);
    }

}
