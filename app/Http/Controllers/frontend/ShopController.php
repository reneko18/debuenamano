<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $product = Product::get();
        return view('shop.fullwidth-left-sidebar',compact('product'));
    }
}
