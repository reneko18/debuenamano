<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
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

    public function displayForm(User $user)
    {
        // Get the authenticated user
        $user = auth()->user();

        // Eager load the bankDetail relation
        $user->load('bankDetail');

        return view('selling.formtest', compact('user'));
    }

    public function displayUnfinishedForm($slug = null)
    {
        // If a product slug is provided, retrieve the product data
        // and pass it to the view to pre-fill the form
        if ($slug) {
            $product = Product::where('slug', $slug)->firstOrFail();
            // Decode the main_step JSON string to an array
            $mainStepArray = json_decode($product->main_step, true);
            // Pass the product data along with the main step array to the view
            return view('selling.formtestunfi', compact('product', 'mainStepArray'));
        }

        // If no product slug is provided, simply render the form view
        return view('selling.formtest');
    }
}
