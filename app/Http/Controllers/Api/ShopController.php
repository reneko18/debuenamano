<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function getArchiveProducts()
    {
        $products = Product::with('category')
            ->where('publish_status', 'En vitrina')
            ->paginate(10); 

        return response()->json($products);
    }

    public function getArchiveCategories()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();

        return response()->json(['categories' => $categories]);
    }
}
