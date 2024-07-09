<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PostController extends Controller
{
    public function index()
    {       

        $posts = Post::with('author','postcategories')->withPostFilters( 
            request()->input('authors', []),            
            request()->input('postcategories', []),    
            request()->input('order', 'desc') // Default to ascending        
        )->paginate(6); 

        return response()->json($posts);
    }

    public function store(Request $request)
    {
        // Generate slug
        $slug = Str::slug($request->input('title'), '-');
        if (Post::where('slug', $slug)->exists()) {
            $currentDate = Carbon::now()->format('d-m-y');
            $slug = $slug . "-" . $currentDate;
        }

        // Create a new post with the slug
        $post = Post::create([
            'title' => $request->input('title'),
            'meta_title' => $request->input('title'),
            'author_id' => $request->input('author_id'),
            'content' => $request->input('content'),
            'slug' => $slug,
        ]);

        // Sync post categories
        $post->postcategories()->sync($request->input('post_category_id'));

        return response()->json(['message' => 'Post created successfully', 'post' => $post], 201);
    }

    public function adminindex()
    {
        $posts = Post::with('author','postcategories')->get();

        return response()->json($posts);
    }
}
