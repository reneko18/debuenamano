<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Providers\CartServiceProvider;
use App\Repositories\CartRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToGuestCart(Request $request, CartServiceProvider $cartProvider)
    {
        $cartData = $request->input('cart_data');
        $cartProvider->addToGuestCart($cartData);
        // Additional logic for adding items to the guest cart
    }

    public function getGuestCart(CartServiceProvider $cartProvider)
    {
        $guestCartData = $cartProvider->getGuestCart();
        return response()->json($guestCartData);
    }

    public function guestCartCount()
    {
        // Implement the logic to count items in the guest cart
        $guestCartCount = (new CartRepository())->guestCartCount(); // You'll need to define this method in your CartRepository

        return response()->json([
            'count' => $guestCartCount
        ]);
    }

    //END NEW CODE



    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::where('id', $request->productId)->first();
        $count = (new CartRepository())->add($product);
        return response()->json([
            'count' => $count
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function count()
    {
        $count = (new CartRepository())->count();

        return response()->json([
            'count' => $count
        ]);
    }




}
