<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\AuthorImage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class AuthorImageController extends Controller
{
    public function store(Author $author,Request $request)
    {

          $this->validate(request(),[
            'image' => 'image',
          ]);   
          
        
          $photo = request()->file('image');
          $name = $photo->getClientOriginalName();  
          $filename = pathinfo($name, PATHINFO_FILENAME);
          $extension = $request->file('image')->getClientOriginalExtension();
          $photoName = $filename.time().'.' .$extension;         
          $photoUrl = $photo->storeAs('author-profil',$photoName);
          $photoUrl = "images/author-profil/" . $photoName;                  
          $imageUpload = new AuthorImage();
          $imageUpload->author_id = $author->id;          
          $imageUpload->url = $photoUrl;        
          $imageUpload->save();
          return response()->json(['success'=>$photoName]);
          
    }

    public function destroy(AuthorImage $image)
    {     


      $pathname = $image->url;    
      if( file_exists($pathname) ){      
        File::delete($pathname);
      }
      $image->delete();
      return back();
      
    }
}
