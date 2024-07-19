<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

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

        // Handle main image upload if provided
        $mainImageUrl = null;
        if ($request->has('main_img')) {
            $mainImageBase64 = $request->input('main_img');
            $mainImage = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $mainImageBase64));

            // Generate unique filename for main image
            $mainImageName = 'main_image_' . Str::random(10) . '.jpg';
            $mainImagePath = public_path('images/post-main-image') . '/' . $mainImageName;

            // Save main image to the specified directory
            file_put_contents($mainImagePath, $mainImage);

            // Get URL of the uploaded main image
            $mainImageUrl = url('images/post-main-image/' . $mainImageName);
        }

        // Create a new post with the slug
        $post = Post::create([
            'title' => $request->input('title'),
            'meta_title' => $request->input('title'),
            'author_id' => $request->input('author_id'),
            'content' => $request->input('content'),
            'main_img' => $mainImageUrl,
            'slug' => $slug,
        ]);

        // Sync post categories
        $post->postcategories()->sync($request->input('post_category_id'));

        return response()->json(['message' => 'Post created successfully', 'post' => $post], 201);
    }

    // public function adminindex()
    // {
    //     $posts = Post::with('author','postcategories')->get();

    //     return response()->json($posts);
    // }
    public function adminindex()
    {
        $posts = Post::with('author', 'postcategories')->get()->map(function($post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'authorFullName' => $post->author->firstname . ' ' . $post->author->lastname,
                'categoryName' => $post->postcategories->isNotEmpty() ? $post->postcategories->first()->name : 'No Category',
                'created_at' => $post->created_at->toDateTimeString(),
            ];
        });
    
        return response()->json($posts);
    }   

    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        // Delete related entries in post_category table
        $post->postcategories()->detach();

        // Now delete the post
        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }

}
