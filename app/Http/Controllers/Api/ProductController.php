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

    // Helper function to map region codes to region names
    public function mapRegionCodeToName($regionCode) {
        $regionNames = [
            'R1' => 'TARAPACA',
            'R2' => 'ANTOFAGASTA',
            'R3' => 'ATACAMA',
            'R4' => 'COQUIMBO',
            'R5' => 'VALPARAISO',
            'R6' => 'LIBERTADOR GRAL BERNARDO O HIGGINS',
            'R7' => 'MAULE',
            'R8' => 'BIOBIO',
            'R9' => 'ARAUCANIA',
            'RM' => 'METROPOLITANA DE SANTIAGO',
            'R10' => 'LOS LAGOS',
            'R11' => 'AISEN DEL GRAL C IBANEZ DEL CAMPO',
            'R12' => 'MAGALLANES Y LA ANTARTICA CHILENA',
            'R14' => 'LOS RIOS',
            'R15' => 'ARICA Y PARINACOTA',
            'R16' => 'NUBLE',
        ];

        return $regionNames[$regionCode] ?? null;
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
        //Dimensiones Producto Desarmado
        $product->length_real = $request->input('stepThreeLengthReal');
        $product->length_real_unit = $request->input('stepThreeLengthRealUnit');
        $product->width_real = $request->input('stepThreeWidthReal');
        $product->width_real_unit = $request->input('stepThreeWidthRealUnit');
        $product->height_real = $request->input('stepThreeHeightReal');
        $product->height_real_unit = $request->input('stepThreeHeightRealUnit'); 

        
        // Check if weight unit is in grams ("g") and convert to kilograms ("kg")
        if ($request->input('stepThreeWeightUnit') === 'g') {
            // Divide weight by 1000 to convert grams to kilograms
            $product->weight /= 1000;
            // Change weight unit to kilograms
            $product->weight_unit = 'Kg';
        }
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
        //Dimensiones Producto Embalado
        $deliveryInformation->length = $request->input('stepThreeLength');
        $deliveryInformation->length_unit = $request->input('stepThreeLengthUnit');
        $deliveryInformation->width = $request->input('stepThreeWidth');
        $deliveryInformation->width_unit = $request->input('stepThreeWidthUnit');
        $deliveryInformation->height = $request->input('stepThreeHeight');
        $deliveryInformation->height_unit = $request->input('stepThreeHeightUnit'); 
        $deliveryInformation->weight = $request->input('stepThreeWeight');
        $deliveryInformation->weight_unit = $request->input('stepThreeWeightUnit');
        $deliveryInformation->option = $request->input('stepSevenOptionDelivery');
        $deliveryInformation->region_code = $request->input('stepSevenRegion');
        $regionName = $this->mapRegionCodeToName($request->input('stepSevenRegion'));
        $deliveryInformation->region_name = $regionName;
        $deliveryInformation->city_name = $request->input('stepSevenCity.countyName');
        $deliveryInformation->city_code = $request->input('stepSevenCity.countyCode');
        $deliveryInformation->chile_office = $request->input('stepSevenChilexpressOffice');
        $deliveryInformation->address = $request->input('stepSevenStreet');
        $deliveryInformation->address_number = $request->input('stepSevenStreetNumber');
        $deliveryInformation->dpto_house = $request->input('stepSevenStreetDptoHouse');

        if ($request->input('stepSevenOptionDelivery') === 'Domicilio') {
            $deliveryInformation->recover_price = 3500;
        }

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
            $src = str_replace('data:image/png;base64,', '', $imageData['src']); 
            $originalName = $imageData['name'];
            $name = preg_replace('/[^\w\d\.\-_]/', '_', $originalName); 
                    
            // Add unique identifier to the image name
            $imageName = uniqid() . '_' . $name;
                    
            // Save the image to the public folder
            $imagePath = public_path('images/products_images/' . $imageName);
            $decodedImage = base64_decode($src);
        
            file_put_contents($imagePath, $decodedImage);
        
            // Save image data to the database
            $product->galleries()->create([
                'product_id' => $product->id,
                'url' => 'images/products_images/' . $imageName,
                'alt' => $originalName,
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

    public function getProductsDraftByUserId($user_id)
    {
    // Assuming you have a 'products' table with a 'user_id' and 'publish_status' column
    $products = Product::where('user_id', $user_id)
        ->whereIn('publish_status', ['Guardado/borrador'])
        ->get();

    return response()->json($products);
    }

    public function getProductsPublishedByUserId($user_id)
    {
    // Assuming you have a 'products' table with a 'user_id' and 'publish_status' column
    $products = Product::with('category','galleries')
        ->where('user_id', $user_id)
        ->whereIn('publish_status', ['En revisión'])
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

    public function getProductsSoldByUserId($user_id)
    {
        // Fetch products based on user_id and publish_status
        $products = Product::where('user_id', $user_id)
        ->where('publish_status', 'Vendido')
        ->with('category','galleries')
        ->get();

        // Return the products as JSON response
        return response()->json($products);
    }

    public function getProductsByPublishStatus()
    {
        $products = Product::with('productContacts', 'category', 'user')
            ->where('publish_status', 'En vitrina')
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


    public function getProductsAdminDraftByUserId()
    {
        $products = Product::with('category', 'user')  
            ->whereIn('publish_status', ['Guardado/borrador']) 
            ->get();
    
        $productsWithData = $products->map(function ($product) {
            return [
                'product' => $product,
                'sellerFullName' => optional($product->user)->name . ' ' . optional($product->user)->lastname, 
            ];
        });
    
        return response()->json($productsWithData);
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

    public function updateAdminStatus(Product $product)
    {
        try {
            $productAdminStatus = request('product_admin_status');
    
            // If the admin status is "Finalizado", update the selling status to "Pendiente"
            if ($productAdminStatus === 'Finalizado') {
                $product->update([
                    'admin_status' => $productAdminStatus,
                    'payment_status' => 'Pendiente'
                ]);
            } else {
                $product->update(['admin_status' => $productAdminStatus]);
            }
    
            return response()->json(['message' => 'Product updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update product'], 500);
        }
    }

    public function updateProductPaymentStatus(Product $product)
    {
        try {
            $productPaymentStatus = request('product_payment_status');       
  
            $product->update([
                'payment_status' => $productPaymentStatus,
                'payment_date' => now()->format('d/m/Y'),
            ]);       
    
            return response()->json(['message' => 'Product updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update product'], 500);
        }
    }

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
                'gender_id',
                'age_filter_id',
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
                'visible_status',
            ]);

            // Calculate the discount percentage
            if (isset($requestData['price']) && isset($requestData['reference_price'])) {
                $priceFormatted = $requestData['price'];
                $priceReferenceFormatted = $requestData['reference_price'];
                
                // Ensure reference price is not zero to avoid division by zero
                if ($priceReferenceFormatted > 0) {
                    $productDiscount = round((($priceReferenceFormatted - $priceFormatted) / $priceReferenceFormatted) * 100);
                    $requestData['reduction_percent'] = $productDiscount;
                }
            }

            // Update product information
            $product->update($requestData);

    
            // Update published_at to the current timestamp
            $product->published_at = now();
            $product->save();
          
    
            // If you have nested data, you might want to format it properly before updating
            $deliveryInformationData = request()->only([
                'option',
                'region_code',
                'region_name',
                'city_name',
                'city_code',
                'chile_office',
                'address',
                'address_number',
                'dpto_house',
            ]);

            // Update delivery information if provided
            if (!empty($deliveryInformationData)) {
                $product->deliveryInformation()->updateOrCreate([], $deliveryInformationData);
            }

            $bankDetailsData = request()->only([
                'full_name',
                'bank',
                'account_number',
                'account_type',
                'rut',
            ]);

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
                'gender_id',
                'age_filter_id',
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
                'reference_price', 
                'publish_status',
                'visible_status',
            ]);
    
            // If you have nested data, you might want to format it properly before updating
            $deliveryInformationData = request()->only([
                'option',
                'region_code',
                'region_name',
                'city_name',
                'city_code',
                'chile_office',
                'address',
                'address_number',
                'dpto_house',
            ]);

            $bankDetailsData = request()->only([
                'full_name',
                'bank',
                'account_number',
                'account_type',
                'rut',
            ]);

            // Calculate the discount percentage
            if (isset($requestData['price']) && isset($requestData['reference_price'])) {
                $priceFormatted = $requestData['price'];
                $priceReferenceFormatted = $requestData['reference_price'];
                
                // Ensure reference price is not zero to avoid division by zero
                if ($priceReferenceFormatted > 0) {
                    $productDiscount = round((($priceReferenceFormatted - $priceFormatted) / $priceReferenceFormatted) * 100);
                    $requestData['reduction_percent'] = $productDiscount;
                }
            }
    
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
        $products = Product::with('category', 'user','orders.user','deliveryInformation')  
            ->whereIn('admin_status', ['Comprado', 'En courier', 'Entregado', 'Devuelto', 'Finalizado'])
            ->get();
    
        $products = $products->map(function ($product) {
            $buyerFullName = null; 
            $order = $product->orders->first();
            if ($order && $order->user_id) {
                $user = User::find($order->user_id);
                if ($user) {
                    $buyerFullName = "{$user->name} {$user->lastname}";    
                }
            }
            $deliveryPrice = null;
            if ($order) {
                // Accessing delivery_price directly through the pivot table relationship
                $deliveryPrice = $order->pivot->delivery_price;
            }
            return [
                'product' => $product,  
                'sellerFullName' => $product->user ? "{$product->user->name} {$product->user->lastname}" : null,
                'buyerFullName' => $buyerFullName,
                'deliveryPrice' => $deliveryPrice,
            ];
        });
    
        return response()->json($products);    

    }

    public function getProductAdminCloseSelling()
    {
        $products = Product::with('category', 'user','orders.user','deliveryInformation')  
        ->whereIn('payment_status', ['Pendiente','Pagado'])
        ->get();

        $products = $products->map(function ($product) {
            $buyerFullName = null;
            $buyerRegion = null;
            $buyerCity = null;
            $order = $product->orders->first();
            if ($order && $order->user_id) {
                $user = User::find($order->user_id);
                if ($user) {
                    $buyerFullName = "{$user->name} {$user->lastname}";
                    $buyerRegion = "{$user->region}";
                    $buyerCity = "{$user->city}";
                }
            }
            $deliveryPrice = null;
            if ($order) {
                // Accessing delivery_price directly through the pivot table relationship
                $deliveryPrice = $order->pivot->delivery_price;
            }
            return [
                'product' => $product,  
                'sellerFullName' => $product->user ? "{$product->user->name} {$product->user->lastname}" : null,
                'buyerFullName' => $buyerFullName,
                'buyerRegion' => $buyerRegion,
                'buyerCity' => $buyerCity,
                'deliveryPrice' => $deliveryPrice,
            ];
        });

        return response()->json($products);    
    }
    

    
    public function destroyProduct(Product $product)
    {
        $product->deliveryInformation()->delete();

        $product->delete();
    
        return response()->json(['message' => 'Product deleted successfully']);
    }

    public function updateVisibleStatusProduct(Product $product)
    {
        $product->update(['visible_status' => request()->input('visible_status')]);
        
        return response()->json(['message' => 'Product Visible Status Updated']);
    }

    public function getProductAdminPayment()
    {
        $products = Product::with('category', 'user','orders.user','deliveryInformation')  
        ->whereIn('payment_status', ['Pagado'])
        ->get();

        $products = $products->map(function ($product) {
            $buyerFullName = null;
            $order = $product->orders->first();
            if ($order && $order->user_id) {
                $user = User::find($order->user_id);
                if ($user) {
                    $buyerFullName = "{$user->name} {$user->lastname}";
                }
            }
            $deliveryPrice = null;
            if ($order) {
                // Accessing delivery_price directly through the pivot table relationship
                $deliveryPrice = $order->pivot->delivery_price;
            }
            $orderId = null;
            if ($order) {
                // Accessing delivery_price directly through the pivot table relationship
                $orderId = $order->pivot->order_id;
            }
            return [
                'product' => $product,  
                'sellerFullName' => $product->user ? "{$product->user->name} {$product->user->lastname}" : null,
                'buyerFullName' => $buyerFullName,
                'deliveryPrice' => $deliveryPrice,
                'orderId' => $orderId,
            ];
        });

        return response()->json($products);    
    }

    public function getProductAdminIncoming()
    {
        $products = Product::with('category', 'user','orders.user','deliveryInformation')  
        ->whereIn('payment_status', ['Pagado'])
        ->get();

        $products = $products->map(function ($product) {
            $buyerFullName = null;
            $order = $product->orders->first();
            if ($order && $order->user_id) {
                $user = User::find($order->user_id);
                if ($user) {
                    $buyerFullName = "{$user->name} {$user->lastname}";
                }
            }
            $deliveryPrice = null;
            if ($order) {
                // Accessing delivery_price directly through the pivot table relationship
                $deliveryPrice = $order->pivot->delivery_price;
            }
            return [
                'product' => $product,  
                'sellerFullName' => $product->user ? "{$product->user->name} {$product->user->lastname}" : null,
                'buyerFullName' => $buyerFullName,
                'deliveryPrice' => $deliveryPrice,
            ];
        });

        return response()->json($products);    
    }

    public function getTotalProductsByUserId($user_id)
    {
        // Fetch the total number of products with 'En vitrina' or 'Vendido' status
        $totalProducts = Product::where('user_id', $user_id)
                                ->whereIn('publish_status', ['En vitrina', 'Vendido'])
                                ->count();
    
        return response()->json(['total' => $totalProducts]);
    }
}
