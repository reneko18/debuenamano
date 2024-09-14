<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::withCount(['posts' => function ($query) {
            $query->withPostFilters(
                request()->input('authors', []),            
                request()->input('postcategories', []),              
            );
        }])->get();       
    
        return response()->json($authors);
    }

    public function adminindex()
    {
        $authors = Author::get();

        $authorWithData = $authors->map(function ($author) {
            return [
                'author' => $author,
                'authorFullName' => $author->firstname . ' ' . $author->lastname, 
            ];
        });

        return response()->json($authorWithData);
    }

    public function store(Request $request)
    {

        // Handle main image upload if provided
        $mainImageUrl = null;
        if ($request->has('main_img')) {
            $mainImageBase64 = $request->input('main_img');
            $mainImage = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $mainImageBase64));

            // Generate unique filename for main image
            $mainImageName = 'main_image_' . Str::random(10) . '.jpg';
            $mainImagePath = public_path('images/author_profil') . '/' . $mainImageName;

            // Save main image to the specified directory
            file_put_contents($mainImagePath, $mainImage);

            // Get URL of the uploaded main image
            $mainImageUrl = url('images/author_profil/' . $mainImageName);
        }

        // Create a new author
        $author = Author::create([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'main_img' => $mainImageUrl,
        ]);


        return response()->json(['message' => 'Author created successfully', 'author' => $author], 201);
    }

    public function destroy($id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json(['message' => 'Author not found'], 404);
        }

        // Now delete the author
        $author->delete();

        return response()->json(['message' => 'Author deleted successfully']);
    }

    // public function getAuthorPosts(Author $author)
    // {

    //     $posts = $author->posts()->with('author','postcategories')->withAuthorFilters(           
    //         request()->input('postcategories', []),    
    //         request()->input('order', 'desc')      
    //     )->paginate(6);    
     
    //     return response()->json($posts);
    // }

    public function getAuthorPosts(Author $author)
    {
        // Use the Post model to filter posts by author_id and apply the custom scope
        $posts = Post::where('author_id', $author->id)
            ->with('author', 'postcategories')
            ->withAuthorFilters(
                request()->input('postcategories', []),
                request()->input('order', 'desc')
            )
            ->paginate(6);

        return response()->json($posts);
    }
    
}
