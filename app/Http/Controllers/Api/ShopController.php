<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AgeFilter;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function getArchiveProducts()
    {
        $category_id = request()->input('category_id');
        $genre = request()->input('genre');
        $min_price = request()->input('min_price');
        $max_price = request()->input('max_price');
        $age = request()->input('age_filter_id');
        $search_query = request()->input('search_query');
        $order = request()->input('order', 'desc');

        $products = Product::with('category')
            ->where('publish_status', 'En vitrina')
            ->withFilters($category_id, $genre, $min_price, $max_price,$age,$search_query,$order)
            ->paginate(12); 

        return response()->json($products);
    }

    public function getArchiveCategories()
    {
        $category_id = request()->input('category_id');
        $genre = request()->input('genre');
        $min_price = request()->input('min_price');
        $max_price = request()->input('max_price');
        $age = request()->input('age_filter_id');
        $search_query = request()->input('search_query');
        $order = request()->input('order', 'desc');        

        $categories = Category::with(['children','product' => function ($query) use ($category_id, $genre, $min_price, $max_price, $age, $search_query,$order) {
            $query->withFilters($category_id, $genre, $min_price, $max_price, $age, $search_query,$order);
        }])
        ->whereNull('parent_id')
        ->get();

        return response()->json(['categories' => $categories]);
    }

    public function getAgeFilters()
    {
        $agefilters = AgeFilter::get();

        return response()->json($agefilters);
    }

}
