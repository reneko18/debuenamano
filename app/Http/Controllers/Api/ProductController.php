<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BankDetail;
use App\Models\DeliveryInformation;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class ProductController extends Controller
{
    //ES PARA QUE SOLO LOS USUARIOS LOGEADOS PUEDAN CREAR PRODUCTOS, ESTO ES PARA TODOS LOS METODOS PRESENTES ACA
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }


    public function store(Request $request)
    {

        $product = new Product();
        //Presentacion
        $product->name = $request->input('stepOneNameProduct');
        $product->category_id = $request->input('stepOneCategoryProduct.id');
        $product->genre = $request->input('stepOneGenre');
        $product->age_ini = $request->input('stepOneAgeIni');
        $product->age_date_ini = $request->input('stepOneAgeDateIni');
        $product->age_fin = $request->input('stepOneAgeFin');
        $product->age_date_fin = $request->input('stepOneAgeDateFin');
        $product->description = $request->input('stepOneDescriptionProduct');
        //Marca
        $product->brand = $request->input('stepTwoBrandProduct');
        $product->model = $request->input('stepTwoModelProduct');
        //Dimensiones
        $product->length = $request->input('stepThreeLength');
        $product->length_unit = $request->input('stepThreeLengthUnit');
        $product->width = $request->input('stepThreeWidth');
        $product->width_unit = $request->input('stepThreeWidthUnit');
        $product->height = $request->input('stepThreeHeight');
        $product->height_unit = $request->input('stepThreeHeightUnit'); 
        $product->weight = $request->input('stepThreeWeight');
        $product->weight_unit = $request->input('stepThreeWeightUnit');
        $product->delivery_box = $request->input('stepThreeBox');
        //Uso
        $product->status = $request->input('stepFourState');
        $product->used_time = $request->input('stepFourUsageTime');
        $product->used_time_unit = $request->input('stepFourUsageUnit');
        //Observaciones
        $product->remark = $request->input('stepFiveDetails');
        $product->advice = $request->input('stepFiveAdvice');
        //Precio
        $product->price = $request->input('stepEightPrice');
        //Publish Status
        $product->publish_status = "En revisión";
        //Slug
        $slug = Str::slug($product->name,'-')."-";
        $slug .= Carbon::now()->timestamp;
        $product->slug = $slug;

        //Usuario
         // Associate the product with the currently logged-in user
        $user = auth()->user();
        $product->user()->associate($user);

     
        $product->save();

        $deliveryInformation = new DeliveryInformation();
        $deliveryInformation->product_id = $product->id;
        $deliveryInformation->option = $request->input('stepSevenOptionDelivery');
        $deliveryInformation->region = $request->input('stepSevenRegion');
        $deliveryInformation->city = $request->input('stepSevenCity');
        $deliveryInformation->chile_office = $request->input('stepSevenChilexpressOffice');
        $deliveryInformation->address = $request->input('stepSevenStreet');
        $deliveryInformation->address_number = $request->input('stepSevenStreetNumber');

        $product->deliveryInformation()->save($deliveryInformation);

        $bankDetails = new BankDetail();
        $bankDetails->user_id = auth()->id();
        $bankDetails->full_name = $request->input('stepNineName');
        $bankDetails->bank = $request->input('stepNineBank');
        $bankDetails->account_number = $request->input('stepNineBankNumber');
        $bankDetails->rut = $request->input('stepNineRut');
        $bankDetails->account_type = $request->input('stepNineBankType');   

        $product->user->bankDetail()->save($bankDetails);

        $imagesData = $request->input('stepSixPhoto');

        foreach ($imagesData as $imageData) {
            $src =  str_replace('data:image/png;base64,', '', $imageData['src']); 
            $name = $imageData['name'];
            $name = preg_replace('/[^\w\d\.\-_]/', '_', $name);           


            // Save the image to the public folder
            $imagePath = public_path('images/products_images/' . $name);
            $decodedImage = base64_decode($src);

            file_put_contents($imagePath, $decodedImage);

            // Save image data to the database
            $product->galleries()->create([
                'product_id' => $product->id,
                'url' => 'images/products_images/' . $name,
                'alt' => $name,
                'position' => null,
            ]);
        } 
        

        return response()->json(['message' => 'Product and images uploaded successfully']);
        

      
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

    public function getProductsPublishedByUserId($user_id)
    {
    // Assuming you have a 'products' table with a 'user_id' and 'publish_status' column
    $products = Product::with('category')
        ->where('user_id', $user_id)
        ->whereIn('publish_status', ['Guardado/borrador', 'En revisión'])
        ->get();

    return response()->json($products);
    }

    public function getProductsDisplayedByUserId($user_id)
    {
    // Assuming you have a 'products' table with a 'user_id' and 'publish_status' column
    $products = Product::with('category')
        ->where('user_id', $user_id)
        ->whereIn('publish_status', ['En vitrina'])
        ->get();

    return response()->json($products);
    }

    public function getProductsPurchasedByUserId($user_id)
    {
        // Retrieve the user
        $user = User::find($user_id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Get the orders for the user and eager load the product details along with the order
        $orders = $user->orders()->with('product.category')->get();

        // Extract products from orders and include status information
        $products = $orders->map(function ($order) {
            return [
                'product' => $order->product,
                'status' => $order->status, // Assuming the status is directly in the orders table
            ];
        });

        return response()->json($products);
    }

    public function getProductsByPublishStatus()
    {
        $products = Product::with('productContacts', 'category', 'user')
            ->where('publish_status', 'En Vitrina')
            ->get();
    
        $productsWithSellerFullName = $products->map(function ($product) {
            $editUrl = route('productos.edit', $product->slug);
            return [
                'product' => $product,
                'editUrl' => $editUrl,
                'sellerFullName' => $product->user ? "{$product->user->name} {$product->user->lastname}" : null,
                'sellerMail' => $product->user ? "{$product->user->email}" : null,
            ];
        });
    
        return response()->json($productsWithSellerFullName);
    }

    public function getProductsAdminPublishedByUserId()
    {
        $products = Product::with('category', 'user')  
            ->whereIn('publish_status', ['En revisión'])
            ->get();
    
        $productsWithEditUrl = $products->map(function ($product) {
            $editUrl = route('productos.edit', $product->slug);
            return [
                'product' => $product,
                'editUrl' => $editUrl,
                'sellerFullName' => $product->user ? "{$product->user->name} {$product->user->lastname}" : null,
            ];
        });
    
        return response()->json($productsWithEditUrl);
    }
    

    public function updateSellingStatus(Product $product)
    {
        try {   
            // Assuming the request body has a 'selling_status' field
            $product->update(['selling_status' => request('selling_status')]);
    
            return response()->json(['message' => 'Product updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update product'], 500);
        }
    }

    public function updateMediaSelection(Product $product)
    {
        try {   
            // Assuming the request body has a 'selling_status' field
            $product->productContacts()->sync(request('product_contacts'));    
            return response()->json(['message' => 'Product updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update product'], 500);
        }
    }
    


}
