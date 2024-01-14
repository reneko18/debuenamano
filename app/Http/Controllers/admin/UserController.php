<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();

        return view('admin.users.index', compact('users'));
    }

    public function adminUser(User $user)
    {
        return view('useradmin.index', compact('user'));
    }

    public function updateImageProfil(Request $request,User $user)
    {
      $data = $request->image;
      $id = $request->id;
  
      list($type, $data) = explode(';', $data);
      list(, $data)      = explode(',', $data);
  
      $data = base64_decode($data);
      $image_name = time() . '.jpg';
      $path = public_path() . "/images/profil-users/" . $image_name;
      $profilurl = "/images/profil-users/" . $image_name;
      $user->profil_url = $profilurl;
      $user->update();
   
      file_put_contents($path, $data);
     
      return response()->json(['status' => 1, 'message' => "Image uploaded successfully"]);   
    }
}
