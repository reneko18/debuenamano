<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Product $product)
    {
        return view('checkout.index',compact('product'));
    }

    // public function order()
    // {
    //     return view('order_end');
    // }
}
