<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    public function addToGuestCart($cartData)
    {
        session()->put('guest_cart', $cartData);
        // Additional logic for managing the guest cart
    }

    public function getGuestCart()
    {
        return session()->get('guest_cart');
    }
}
