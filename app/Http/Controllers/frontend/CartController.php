<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $user = auth()->user();
    
            // Check if the user has a cart
            if (!$user->cart) {
                // If not, create a new cart for the user
                $user->cart()->create();
            }
    
            // Retrieve the cart items from the database
            $cartItems = $user->cart->products ?? [];
            $totalPrice = 0;
    
            if (!empty($cartItems)) {
                // If $cartItems is not empty, calculate the total price
                $totalPrice = collect($cartItems)->sum('price');
            }
        } else {
            // For guest users, use session data
            $cart = Session::get('cart', []);
            $cartItems = collect($cart)->values();  // Ensure numeric keys are preserved
            $totalPrice = $cartItems->sum('price'); 
            $buyOrder = 18;
            $sessionId = 12345;
        }

   

        return view('cart.index', compact('cartItems', 'totalPrice', 'buyOrder','sessionId'));
    }

    public function add(Request $request, Product $product)
    {
                // For authenticated users
                if (Auth::check()) {
                    $user = auth()->user();

                    // Check if the user has a cart
                    if (!$user->cart) {
                        // If not, create a new cart for the user
                        $user->cart()->create();
                        // Reload the user instance to fetch the newly created cart
                        $user->refresh();
                    }

                    // Check if the product is already in the cart
                    if ($user->cart->products()->where('product_id', $product->id)->exists()) {
                        // If so, increment the quantity
                        $user->cart->products()->updateExistingPivot($product->id, ['quantity' => $user->cart->products()->find($product->id)->pivot->quantity + 1]);
                    } else {
                        // If not, add the product to the cart
                        $user->cart->products()->attach($product->id, ['quantity' => 1]);
                    }

                    return redirect()->route('single.show', ['product' => $product->slug])->with('success', 'Product added to cart');
                }

                // For guests
                $cart = Session::get('cart', []);

                // Check if the product is already in the cart
                if (isset($cart[$product->id])) {
                    // If so, increment the quantity
                    $cart[$product->id]['quantity']++;
                } else {
                    // Fetch delivery information for the product
                    $deliveryInformation = $product->deliveryInformation;
                    $galleriesData = [];
                    // $galleries = $product->galleries;
                    // Iterate over each gallery and add its data to the $galleriesData array
                    foreach ($product->galleries as $gallery) {
                        $galleriesData[] = [
                            'url' => $gallery->url,
                            'alt' => $gallery->alt,
                        ];
                    }
                    // If not, add the product to the cart
                    $cart[$product->id] = [
                        'id' => $product->id,
                        'slug' => $product->slug,
                        'quantity' => 1,
                        'name' => $product->name,
                        'price' => $product->price, 

                        'delivery_information' => [
                            'option' => $deliveryInformation->option,
                            'region' => $deliveryInformation->region,
                            'city' => $deliveryInformation->city,
                            'city_code' => $deliveryInformation->city_code,
                            'chile_office' => $deliveryInformation->chile_office,
                            'address' => $deliveryInformation->address,
                            'address_number' => $deliveryInformation->address_number,
                            'dpto_house' => $deliveryInformation->dpto_house,
                            'length' => $deliveryInformation->length,  
                            'width' => $deliveryInformation->width,  
                            'height' => $deliveryInformation->height,  
                            'weight' => $deliveryInformation->weight,  
                        ],
                        // 'galleries' => $galleries->isNotEmpty() ? [
                        //     'url' => $galleries->first()->url,
                        //     'alt' => $galleries->first()->alt,
                        // ] : null, 
                        'galleries' => $galleriesData ?: null,                                                              
                    ];
                }

                // Store the updated cart in the session
                Session::put('cart', $cart);

                // Only set the message for guests
                return redirect()->route('single.show', ['product' => $product->slug])->with('success', 'Product added to cart');
    }

    public function remove(Request $request, Product $product)
    {
        $user = auth()->user();

        // Check if the product is in the cart
        if ($user->cart->products->contains($product->id)) {
            // If so, decrement the quantity
            $quantity = $user->cart->products->find($product->id)->pivot->quantity;

            if ($quantity > 1) {
                $user->cart->products()->updateExistingPivot($product->id, ['quantity' => $quantity - 1]);
            } else {
                // If quantity is 1, remove the product from the cart
                $user->cart->products()->detach($product->id);
            }

            return redirect()->route('cart.index')->with('success', 'Product removed from cart');
        }

        return redirect()->route('cart.index')->with('error', 'Product not found in cart');
    }


    public function newcart(Request $request)
    {
        // Initialize $total variable
        $total = null;

        // Handle AJAX request
        if ($request->ajax()) {
            // Retrieve data from the request
            $total = $request->input('total');

            // Process the data and return a response
            return response()->json(['total' => $total]);
        }

        if (auth()->check()) {
            $user = auth()->user();
    
            // Check if the user has a cart
            if (!$user->cart) {
                // If not, create a new cart for the user
                $user->cart()->create();
            }
    
            // Retrieve the cart items from the database
            $cartItems = $user->cart->products()->with('galleries', 'deliveryInformation')->get();            

            $totalPrice = 0;
            //Ver para mas tarde esto
            $buyOrder = 18;
            $sessionId = 12345;
    
            if (!empty($cartItems)) {
                // If $cartItems is not empty, calculate the total price
                $totalPrice = collect($cartItems)->sum('price');
            }
        } else {
            // For guest users, use session data
            $cart = Session::get('cart', []);
            $cartItems = collect($cart)->values()->all();  // Ensure numeric keys are preserved
            $totalPrice = collect($cartItems)->sum('price');
            $buyOrder = 18;
            $sessionId = 12345;
        } 

        return view('cart.newcart',compact('cartItems','totalPrice','buyOrder','sessionId','total'));
    }
}
