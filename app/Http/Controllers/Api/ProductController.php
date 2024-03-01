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
        // Precio
        $priceString = $request->input('stepEightPrice');
        $priceFormatted = (float)str_replace('.', '', $priceString);
        // Formato Precio
        $product->price = $priceFormatted;
        //Publish Status
        $product->publish_status = "En revisión";
        //SKU
        $product->sku = $this->generateSKU($request->input('stepOneCategoryProduct.name'));
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
        $deliveryInformation->city = $request->input('stepSevenCity.countyName');
        $deliveryInformation->city_code = $request->input('stepSevenCity.countyCode');
        $deliveryInformation->chile_office = $request->input('stepSevenChilexpressOffice');
        $deliveryInformation->address = $request->input('stepSevenStreet');
        $deliveryInformation->address_number = $request->input('stepSevenStreetNumber');
        $deliveryInformation->dpto_house = $request->input('stepSevenStreetDptoHouse');

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
            $imagePath = public_path('images/products_images/' . $name );
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

    public function generateSKU($categoryName)
    {
        // Get the first 3 letters of the category name in uppercase
        $categoryPrefix = strtoupper(substr($categoryName, 0, 3));

        // Get the current date in the format 27012024
        $currentDate = Carbon::now()->format('dmY');

        // Initial SKU with category prefix and current date
        $sku = $categoryPrefix . '-' . $currentDate;

        // Check if any existing products have the same SKU
        $existingProducts = Product::where('sku', 'like', $sku . '%')->get();

        // If there are existing products with the same SKU, add a suffix
        if ($existingProducts->count() > 0) {
            $suffix = $existingProducts->count() + 1;
            $sku .= '-' . $suffix;
        }

        return $sku;
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
    $products = Product::with('category','galleries')
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

    // public function editProduct($product_id) 
    // {
    //     $product = Product::find($product_id);
    //     return response()->json($product);
    // }

    public function editProduct(Product $product) 
    {
        // Load the "category" relationship along with the product
        $product->load('category','galleries','deliveryInformation', 'user.bankDetail');
    
        // Return the product with the category included in the JSON response
        return response()->json($product);
    }

    public function updateProductStatus(Product $product)
    {
        try {   
            $requestData = request()->only([
                'name',
                'genre',
                'age_ini',
                'age_date_ini',
                'age_fin',
                'age_date_fin',
                'description',
                'category_id',
                'brand',
                'model',
                'height',
                'height_unit',
                'width',
                'width_unit',
                'length',
                'length_unit',
                'weight',
                'weight_unit',
                'status',
                'used_time',
                'used_time_unit',
                'remark',
                'advice',
                'price', 
                'publish_status',
            ]);
    
            // If you have nested data, you might want to format it properly before updating
            $deliveryInformationData = request()->only([
                'delivery_information_option',
                'delivery_information_region',
                'delivery_information_city',
                'delivery_information_chile_office',
                'delivery_information_address',
                'delivery_information_address_number',
                'delivery_information_dpto_house',
            ]);

            $bankDetailsData = request()->only([
                'bankFullName',
                'bankName',
                'bankAccount',
                'bankAccountType',
                'bankRut',
            ]);
    
            // Update product information
            $product->update($requestData);
    
            // Update delivery information if provided
            if (!empty($deliveryInformationData)) {
                $product->deliveryInformation()->updateOrCreate([], $deliveryInformationData);
            }

            // Update bank details if provided
            if (!empty($bankDetailsData)) {
                $user = auth()->user();
                $user->bankDetail()->updateOrCreate([], $bankDetailsData);
            }

            // Handle image updates
            foreach (request()->input('images') as $imageData) {
                if (isset($imageData['src'])) {
                    // Base64 encoded image, save it
                    $src =  str_replace('data:image/png;base64,', '', $imageData['src']); 
                    $name = $imageData['name'];
                    $name = preg_replace('/[^\w\d\.\-_]/', '_', $name);           
            
                    // Save the image to the public folder
                    $imagePath = public_path('images/products_images/' . $name );
                    $decodedImage = base64_decode($src);
                    file_put_contents($imagePath, $decodedImage);
            
                    // Save image data to the database
                    $product->galleries()->updateOrCreate(
                        ['url' => 'images/products_images/' . $name],
                        ['alt' => $name, 'position' => null]
                    );
                } elseif (!isset($imageData['url'])) {
                    // Image doesn't have 'src' property and 'url' property, skip it
                    continue;
                } else {
                    // Image already has 'url' property, it's already saved, skip it
                    continue;
                }
            }
            
    
            return response()->json(['message' => 'Product updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update product'], 500);
        }
    }

    public function saveProductStatus(Product $product)
    {
        try {   
            $requestData = request()->only([
                'name',
                'genre',
                'age_ini',
                'age_date_ini',
                'age_fin',
                'age_date_fin',
                'description',
                'category_id',
                'brand',
                'model',
                'height',
                'height_unit',
                'width',
                'width_unit',
                'length',
                'length_unit',
                'weight',
                'weight_unit',
                'status',
                'used_time',
                'used_time_unit',
                'remark',
                'advice',
                'price', 
                'publish_status',
            ]);
    
            // If you have nested data, you might want to format it properly before updating
            $deliveryInformationData = request()->only([
                'delivery_information_option',
                'delivery_information_region',
                'delivery_information_city',
                'delivery_information_chile_office',
                'delivery_information_address',
                'delivery_information_address_number',
                'delivery_information_dpto_house',
            ]);

            $bankDetailsData = request()->only([
                'bankFullName',
                'bankName',
                'bankAccount',
                'bankAccountType',
                'bankRut',
            ]);
    
            // Update product information
            $product->update($requestData);
    
            // Update delivery information if provided
            if (!empty($deliveryInformationData)) {
                $product->deliveryInformation()->updateOrCreate([], $deliveryInformationData);
            }

            // Update bank details if provided
            if (!empty($bankDetailsData)) {
                $user = auth()->user();
                $user->bankDetail()->updateOrCreate([], $bankDetailsData);
            }

            // Handle image updates
            foreach (request()->input('images') as $imageData) {
                if (isset($imageData['src'])) {
                    // Base64 encoded image, save it
                    $src =  str_replace('data:image/png;base64,', '', $imageData['src']); 
                    $name = $imageData['name'];
                    $name = preg_replace('/[^\w\d\.\-_]/', '_', $name);           
            
                    // Save the image to the public folder
                    $imagePath = public_path('images/products_images/' . $name );
                    $decodedImage = base64_decode($src);
                    file_put_contents($imagePath, $decodedImage);
            
                    // Save image data to the database
                    $product->galleries()->updateOrCreate(
                        ['url' => 'images/products_images/' . $name],
                        ['alt' => $name, 'position' => null]
                    );
                } elseif (!isset($imageData['url'])) {
                    // Image doesn't have 'src' property and 'url' property, skip it
                    continue;
                } else {
                    // Image already has 'url' property, it's already saved, skip it
                    continue;
                }
            }
            
    
            return response()->json(['message' => 'Product saved successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to save product'], 500);
        }

    }

    public function getProductsAdminSellingByUserId()
    {
        $products = Product::with('category', 'user')  
            ->whereIn('publish_status', ['Vendido'])
            ->get();
    
        $products = $products->map(function ($product) {
            return [
                'product' => $product,  
                'sellerFullName' => $product->user ? "{$product->user->name} {$product->user->lastname}" : null,
            ];
        });
    
        return response()->json($products);
    }
    

    


}
