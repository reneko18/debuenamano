<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // Retrieve parent categories with associated subcategories
        $categories = Category::with('subcategories')->get();

        return response()->json(['categories' => $categories]);
    }
}
