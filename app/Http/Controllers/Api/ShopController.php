<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AgeFilter;
use App\Models\Category;
use App\Models\Gender;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function getArchiveProducts()
    {
        $category_id = request()->input('category_id');
        $gender_id = request()->input('gender_id');
        $min_price = request()->input('min_price');
        $max_price = request()->input('max_price');
        $age = request()->input('age_filter_id');
        $search_query = request()->input('search_query');
        $order = request()->input('order', 'desc');

        $products = Product::with('category','galleries')
            ->where('publish_status', 'En vitrina')
            ->withFilters($category_id, $gender_id, $min_price, $max_price,$age,$search_query,$order)
            ->paginate(12); 

        return response()->json($products);
    }

    public function getArchiveCategories()
    {
        $category_id = request()->input('category_id');
        $gender_id = request()->input('gender_id');
        $min_price = request()->input('min_price');
        $max_price = request()->input('max_price');
        $age = request()->input('age_filter_id');
        $search_query = request()->input('search_query');
        $order = request()->input('order', 'desc');        

        $categories = Category::with(['children','product' => function ($query) use ($category_id, $gender_id, $min_price, $max_price, $age, $search_query,$order) {
            $query->withFilters($category_id, $gender_id, $min_price, $max_price, $age, $search_query,$order);
        }])
        ->whereNull('parent_id')
        ->get();

        return response()->json(['categories' => $categories]);
    }

    public function getGenders()
    {
        $category_id = request()->input('category_id');
        $gender_id = request()->input('gender_id');
        $min_price = request()->input('min_price');
        $max_price = request()->input('max_price');
        $age = request()->input('age_filter_id');
        $search_query = request()->input('search_query');
        $order = request()->input('order', 'desc');
    
        $genders = Gender::with(['product' => function ($query) use ($category_id, $gender_id, $min_price, $max_price, $age, $search_query, $order) {
            $query->withFilters($category_id, $gender_id, $min_price, $max_price, $age, $search_query, $order);
        }])->get();
    
        return response()->json($genders);
    }

    public function getAgeFilters()
    {
        $agefilters = AgeFilter::get();

        return response()->json($agefilters);
    }


    public function getRelatedProducts(Request $request)
    {
        $categoryId = $request->query('category_id');
        $excludeId = $request->query('exclude_id');       

        
        $relatedProducts = Product::where('category_id', $categoryId)
                          ->where('id', '!=', $excludeId)
                          ->with('galleries')
                          ->inRandomOrder()
                          ->take(4)
                          ->get();
                                  
        return response()->json($relatedProducts);
    }  

}
