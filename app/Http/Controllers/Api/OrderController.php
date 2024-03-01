<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;

class OrderController extends Controller
{
    public function storeOrder(Request $request)
    {
            // Validate the request data as needed

            // Create a new user record
            $timestamp = now()->timestamp;
            $password = Str::random(10); // Generate a random password with 10 characters
            $user = User::create([
                'name' => $request->form['firstname'],
                'lastname' => $request->form['lastname'],
                'email' => $request->form['email'],
                'phone' => $request->form['phone'],
                'password' => Hash::make($password), // Hash the generated password
                'slug' => Str::slug($request->form['firstname'] . '-' . $request->form['lastname'] . '-' . $timestamp),
            ]);
            // Assign the 'customer' role to the new user
            $customerRole = Role::where('name', 'customer')->first();
            if ($customerRole) {
                $user->assignRole($customerRole);
            }

            // After creating the user
            Mail::to($user->email)->send(new WelcomeEmail($user, $password));

            // Create a new order record
            $order = Order::create([
                'user_id' => $user->id,
                'status' => 'Vendido', // Or any other status you want to set
            ]);

            // Attach products to the order in the pivot table with their delivery prices
            foreach ($request->items as $item) {
                // Find the product by ID
                $product = Product::findOrFail($item['id']);

                // Attach the product to the order with the delivery price (selectedService.serviceValue)
                $order->products()->attach($product->id, [
                    'delivery_price' => $item['selectedService']['serviceValue']
                ]);
            }

            // Update the publish_status of the product
            $product->update(['publish_status' => 'Vendido']);

            // You can return a response indicating the success of the operation
            return response()->json(['message' => 'Order created successfully'], 201);
    }
}
