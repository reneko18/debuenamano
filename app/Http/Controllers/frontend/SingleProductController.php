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

    public function singleShow()
    {
        return view('product.single');
    }
}
