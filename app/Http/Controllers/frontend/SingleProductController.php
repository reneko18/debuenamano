<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SingleProductController extends Controller
{
    public function show(Product $product)
    {
        return view('product.shop-product-basic', compact('product'));
    }

    public function singleShow(Product $product)
    {
        // $allp = Product::all()->random(4);
        return view('product.single', compact('product'));
    }

    public function loop()
    {
        $products = Product::orderBy('created_at', 'desc')->take(9)->get();
        return view('product.loop',compact('products'));
    }


}
