<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index($user_id)
    {
        $user = User::with('bankDetail')->find($user_id);

        return response()->json($user);
    }

    public function updatepersinfo(User $user)
    {          
        try {   
            
            $user->update([
                'phone' => request('phone'),
                'birthdate' => request('birthdate'),
            ]);
 
            return response()->json(['message' => 'Datos de usuario actualizados']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar datos de usuario'], 500);
        }
    }

    public function updatepass(User $user)
    {          
        try {   
            
            $user->update([
                'password' => Hash::make(request('password')),
            ]);
 
            return response()->json(['message' => 'Datos de usuario actualizados']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar datos de usuario'], 500);
        }
    }

    public function bankdetails(User $user)
    {          
        try {   
            
            $bankDetailData = [
                'full_name' => request('full_name'),
                'bank' => request('bank'),
                'account_number' => request('account_number'),
                'rut' => request('rut'),
                'account_type' => request('account_type'),
            ];

            $user->bankDetail()->updateOrCreate([], $bankDetailData);
 
            return response()->json(['message' => 'Datos de usuario actualizados']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar datos de usuario'], 500);
        }
    }

    public function getbankdetails($user_id)
    {
        $user = User::with('bankDetail')->find($user_id);

        // Check if the user exists
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Return the user's bank details as JSON
        return response()->json($user->bankDetail);
    }

    public function uploadImage(Request $request,User $user)
    {
        $imagesData = $request->input('profilImage');

        if (!is_array($imagesData)) {
            return response()->json(['message' => 'Invalid data format'], 400);
        }

        foreach ($imagesData as $imageData) {
            // $src = str_replace('data:image/png;base64,', '', $imageData['src']); 
            // Check the image type and remove the appropriate base64 prefix
            if (strpos($imageData['src'], 'data:image/png;base64,') === 0) {
                $src = str_replace('data:image/png;base64,', '', $imageData['src']);
            } elseif (strpos($imageData['src'], 'data:image/jpeg;base64,') === 0) {
                $src = str_replace('data:image/jpeg;base64,', '', $imageData['src']);
            } else {
                // Handle other image types if necessary or return an error
                return response()->json(['message' => 'Unsupported image format'], 415);
            }
            $originalName = $imageData['name'];
            // $size = $imageData['size'];
            $name = preg_replace('/[^\w\d\.\-_]/', '_', $originalName); 
                    
            // Add unique identifier to the image name
            $imageName = uniqid() . '_' . $name;
                    
            // Save the image to the public folder
            $imagePath = public_path('images/profil-users/' . $imageName);
            $decodedImage = base64_decode($src);
        
            file_put_contents($imagePath, $decodedImage);
        
             // Update user's profile image path
             $user->profil_image = 'images/profil-users/' . $imageName;
             $user->save();  // Save the user with updated profile image path
        }

        // Optionally, you can return a response indicating success or failure
        return response()->json(['message' => 'User image updated successfully'], 200);
    }
}
