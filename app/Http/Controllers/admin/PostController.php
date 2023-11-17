<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::get();
        $postcats = PostCategory::get();
        $authors = Author::get();
        return view('admin.posts.index', compact('posts','postcats','authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $postcats = PostCategory::get();
        $authors = Author::get();
        return view('admin.posts.create',compact('postcats','authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post();
        $post->title = $request->input('title'); 
        $post->author_id = $request->input('author_id');
        $post->meta_title = $request->input('title');

        /*Slug*/
        $slug = Str::slug($post->title,'-');            
     
        if(Post::where('slug',$slug)->exists()){
            $currentDate = Carbon::now()->format('d-m-y');
            $post->slug = $slug."-".$currentDate;
            $post->save(); 
        }else{
            $post->slug = $slug;
            $post->save();    
        } 

        $post->postcategories()->sync($request->input('post_category_id'));

        $post_slug = $post->slug;  

        return redirect()->route('posts.edit', ['post' => $post_slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {    
        return view('post.single',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {   
        $postcats = PostCategory::get();
        $authors = Author::get();
        return view('admin.posts.edit',compact('post','postcats','authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post->title = $request->input('title');
        $post->content = $request->input('content');   
        $post->caption_img = $request->input('caption_img');
        $post->author_id = $request->input('author_id');
        $post->meta_title = $request->input('meta_title');
        $post->meta_description = $request->input('meta_description');
        

        $post->update();
    
        $post->postcategories()->sync($request->post_category_id);

        return to_route('posts.index')->with('flash','El post ha sido editado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function storeImage(Post $post,Request $request)
    {

          $this->validate(request(),[
            'image' => 'image',
          ]);   
          
        
          $photo = request()->file('image');
          $name = $photo->getClientOriginalName();  
          $filename = pathinfo($name, PATHINFO_FILENAME);
          $extension = $request->file('image')->getClientOriginalExtension();
          $photoName = $filename.time().'.' .$extension;         
          $photoUrl = $photo->storeAs('post-main-image',$photoName);
          $photoUrl = "images/post-main-image/" . $photoName;                  
          $post->main_img = $photoUrl;       
          $post->save();
          return response()->json(['success'=>$photoName]);
          
    }

    public function destroyImage(Post $post)
    {
        $pathname = $post->main_img;    
        if( file_exists($pathname) ){      
          File::delete($pathname);
        }
        $post->update(['main_img' => null]);
        return back();
    }

    public function blog()
    {
        $posts = Post::get();
        return view('post.archive', compact('posts'));
    }
}
