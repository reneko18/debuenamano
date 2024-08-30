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

    public function adminindex()
    {
        $postcategories = PostCategory::get();

        return response()->json($postcategories);
    }

    public function store(Request $request)
    {
        // Create a new author
        $category = PostCategory::create([
            'name' => $request->input('category'),
        ]);


        return response()->json(['message' => 'Author created successfully', 'category' => $category], 201);
    }

    public function destroy($id)
    {
        $postcategory = PostCategory::find($id);

        if (!$postcategory) {
            return response()->json(['message' => 'Post Category not found'], 404);
        }

        // Now delete the post
        $postcategory->delete();

        return response()->json(['message' => 'Post Category deleted successfully']);
    }
}
