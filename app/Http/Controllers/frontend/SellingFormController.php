<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SellingFormController extends Controller
{
    public function showform()
    {
        return view('selling.form');
    }

    public function show(User $user)
    {
        // Get the authenticated user
        $user = auth()->user();

        // Eager load the bankDetail relation
        $user->load('bankDetail');

        return view('selling.form', compact('user'));
    }

    public function success()
    {
        return view('selling.success');
    }

    public function display(User $user)
    {
        // Get the authenticated user
        $user = auth()->user();

        // Eager load the bankDetail relation
        $user->load('bankDetail');

        return view('selling.formtest', compact('user'));
    }
}
