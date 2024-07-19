<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = public_path('images/post-content-img');

            // Ensure the directory exists
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            // Move the file to the directory
            $file->move($path, $filename);

            // Return the URL of the uploaded image
            $url = url('images/post-content-img/' . $filename);
            return response()->json(['url' => $url], 200);
        }
        return response()->json(['message' => 'Image upload failed'], 400);
    }
}
