<?php

namespace App\Http\Controllers\Api;

use App\Models\PostCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostCategoryController extends Controller
{
    public function index()
    {       

        $postcats = PostCategory::withCount(['posts' => function ($query) {
            $query->withPostFilters(
                request()->input('authors', []),            
                request()->input('postcategories', []),              
            );
        }])
        ->get();
              
        return response()->json($postcats);
    }
}
