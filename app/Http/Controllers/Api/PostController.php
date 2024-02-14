<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {       

        $posts = Post::with('author','postcategories')->withPostFilters( 
            request()->input('authors', []),            
            request()->input('postcategories', []),            
        )->paginate(6); 

        return response()->json($posts);
    }

    public function adminindex()
    {
        $posts = Post::with('author','postcategories')->get();

        return response()->json($posts);
    }
}
