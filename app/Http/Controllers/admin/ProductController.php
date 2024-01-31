<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::get();
        return view('admin.products.index', compact('product'));
    }
    
    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->input('name');
        $product->sku = $request->input('sku');
        $product->price = $request->input('price');
        $product->description = $request->input('description');

        $product->save();

        return to_route('productos.index')->with('flash','Un nuevo producto ha sido creado');
    }



    public function edit(Product $producto)
    {    
        return view('admin.products.edit', compact('producto'));
    }    

}
