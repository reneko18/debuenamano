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
}
