<?php

namespace App\Repositories;

use App\Models\Product;


class CartRepository
{
    public function add(Product $product)
    {
        \Cart::add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => array(),
            'associatedModel' => $product
        ));
        
        return $this->count();
    }

    public function content()
    {
        if (auth()->check()) {
            return \Cart::session(auth()->user()->id)->getContent();
        } else {
            // For guest users, retrieve the cart from the session
            $guestCartData = session('guest_cart', []);
            \Cart::session('guest')->add($guestCartData);
            return \Cart::getContent();
        }
    }

    public function count()    
    {      
        return $this->content()->count();
    }

    //NEW CODE 

    public function guestCartCount()
    {
        // Retrieve the guest cart data from the session
        $guestCartData = session('guest_cart', []);

        // Calculate the count based on the guest cart data
        $guestCartCount = count($guestCartData);

        return $guestCartCount;
    }
}