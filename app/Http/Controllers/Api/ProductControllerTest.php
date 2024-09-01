<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BankDetail;
use App\Models\DeliveryInformation;
use App\Models\Gender;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;


use Illuminate\Support\Str;
use Carbon\Carbon;


class ProductControllerTest extends Controller
{
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

    public function storePhaseOne(Request $request)
    {               
        $product = new Product();
        //Presentacion
        $product->name = $request->input('stepOneNameProduct');
        $product->category_id = $request->input('stepOneCategoryProduct.id');
        $product->gender_id = $request->input('stepOneGenre');
        $product->age_filter_id = $request->input('stepOneRangeAge');
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
        //Status
        $product->publish_status = 'Guardado/borrador';
        //SKU
        $sanitizedCategoryName = sanitizeString($request->input('stepOneCategoryProduct.name'));
        $product->sku = $this->generateSKU($sanitizedCategoryName);
        //Slug
        $slug = Str::slug($product->name,'-')."-";
        $slug .= Carbon::now()->timestamp;
        $product->slug = $slug;
        //Main Step
        // Define the array
        $mainStepArray = ['1'];

        // Convert the array to JSON format
        // $mainStepJson = json_encode($mainStepArray);
        $mainStepJson = json_encode($mainStepArray);

        // Assign the JSON string to the main_step attribute of the product
        $product->main_step = $mainStepJson;

        //Active Title
        $product->active_title = '1';
        //Received Constant
        $product->received_constant = '2';
        //Current Step
        $product->current_step = '3';

        //Usuario
        // Associate the product with the currently logged-in user
        $user = auth()->user();
        $product->user()->associate($user);

        $deliveryInformation = new DeliveryInformation();
        $deliveryInformation->product_id = $product->id;

        $product->save();


        //Dimensiones Producto Embalado
        $deliveryInformation->length = $request->input('stepThreeLength');
        $deliveryInformation->length_unit = $request->input('stepThreeLengthUnit');
        $deliveryInformation->width = $request->input('stepThreeWidth');
        $deliveryInformation->width_unit = $request->input('stepThreeWidthUnit');
        $deliveryInformation->height = $request->input('stepThreeHeight');
        $deliveryInformation->height_unit = $request->input('stepThreeHeightUnit'); 
        $deliveryInformation->weight = $request->input('stepThreeWeight');
        $deliveryInformation->weight_unit = $request->input('stepThreeWeightUnit');

        // Check if weight unit is in grams ("g") and convert to kilograms ("kg")
        if ($request->input('stepThreeWeightUnit') === 'g') {
            // Divide weight by 1000 to convert grams to kilograms
            $deliveryInformation->weight /= 1000;
            // Change weight unit to kilograms
            $deliveryInformation->weight_unit = 'Kg';
        }

        $product->deliveryInformation()->save($deliveryInformation);

        return response()->json(['message' => 'Product phase 1 uploaded successfully','product' => $product]);
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

    public function storePhaseTwo(Request $request, Product $product)
    {
        //Main Step
        // Define the array
        $mainStepArray = ['1','2'];

        // Convert the array to JSON format
        $mainStepJson = json_encode($mainStepArray);

        // Assign the JSON string to the main_step attribute of the product
        $product->main_step = $mainStepJson;

        //Active Title
        $product->active_title = '2';
        //Received Constant
        $product->received_constant = '3';
        //Current Step
        $product->current_step = '6';
        // Uso
        $product->status = $request->input('stepFourState');
        $product->used_time = $request->input('stepFourUsageTime');
        $product->used_time_unit = $request->input('stepFourUsageUnit');
        // Observaciones
        $product->remark = $request->input('stepFiveDetails');
        $product->advice = $request->input('stepFiveAdvice');
        // Precio
        $priceString = $request->input('stepEightPrice');
        $priceFormatted = (float)str_replace('.', '', $priceString);
        $product->price = $priceFormatted;

        // Save the updated product
        $product->save();

        // Optionally, you can return a response indicating success or failure
        return response()->json(['message' => 'Product updated successfully'], 200);
    }

    public function storePhaseThree(Request $request, Product $product)
    {
        //Main Step
        // Define the array
        $mainStepArray = ['1','2','3'];

        // Convert the array to JSON format
        $mainStepJson = json_encode($mainStepArray);

        // Assign the JSON string to the main_step attribute of the product
        $product->main_step = $mainStepJson;

        //Active Title
        $product->active_title = '3';
        //Received Constant
        $product->received_constant = '4';
        //Current Step
        $product->current_step = '7';

        // Save the product attributes first
        $product->save();

        $imagesData = $request->input('stepSixPhoto');

        foreach ($imagesData as $imageData) {
            // $src = str_replace('data:image/png;base64,', '', $imageData['src']); 
            // Check the image type and remove the appropriate base64 prefix
            if (strpos($imageData['src'], 'data:image/png;base64,') === 0) {
                $src = str_replace('data:image/png;base64,', '', $imageData['src']);
            } elseif (strpos($imageData['src'], 'data:image/jpeg;base64,') === 0) {
                $src = str_replace('data:image/jpeg;base64,', '', $imageData['src']);
            } else {
                // Handle other image types if necessary or return an error
                return response()->json(['message' => 'Unsupported image format'], 415);
            }
            $originalName = $imageData['name'];
            $size = $imageData['size'];
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
                'size' => $size,
                'position' => null,
            ]);
        }

        // Optionally, you can return a response indicating success or failure
        return response()->json(['message' => 'Product updated successfully'], 200);
    }

    public function storePhaseFour(Request $request, Product $product)
    {
        //Main Step
        // Define the array
        $mainStepArray = ['1','2','3','4'];

        // Convert the array to JSON format
        $mainStepJson = json_encode($mainStepArray);

        // Assign the JSON string to the main_step attribute of the product
        $product->main_step = $mainStepJson;

        //Active Title
        $product->active_title = '4';
        //Received Constant
        $product->received_constant = '5';
        //Current Step
        $product->current_step = '9';

        // Save the product attributes first
        $product->save();

        // Retrieve the delivery information associated with the product
        $deliveryInformation = DeliveryInformation::where('product_id', $product->id)->first();

        // If delivery information does not exist, create a new instance
        if (!$deliveryInformation) {
            $deliveryInformation = new DeliveryInformation();
            $deliveryInformation->product_id = $product->id;
        }

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

        // Save or update the delivery information
        $deliveryInformation->save();

        $bankDetails = new BankDetail();
        $bankDetails->user_id = auth()->id();
        $bankDetails->full_name = $request->input('stepNineName');
        $bankDetails->bank = $request->input('stepNineBank');
        $bankDetails->account_number = $request->input('stepNineBankNumber');
        $bankDetails->rut = $request->input('stepNineRut');
        $bankDetails->account_type = $request->input('stepNineBankType');   

        $product->user->bankDetail()->save($bankDetails);

        // Optionally, you can return a response indicating success or failure
        return response()->json(['message' => 'Product updated successfully'], 200);
    }

    public function changeDraftStatus(Request $request, Product $product)
    {
        //Main Step
        // Define the array
        $mainStepArray = ['1','2','3','4'];

        // Convert the array to JSON format
        $mainStepJson = json_encode($mainStepArray);

        // Assign the JSON string to the main_step attribute of the product
        $product->main_step = $mainStepJson;

        //Active Title
        $product->active_title = '4';
        //Received Constant
        $product->received_constant = '5';
        
        //Current Step
        $product->current_step = '9';
        $product->publish_status = $request->input('status');

        $product->save();

        // Optionally, you can return a response indicating success or failure
        return response()->json(['message' => 'Product updated successfully'], 200);
    }

    public function getInfo(Product $product)
    {
        // Eager load the deliveryInformation and category relations
        $product->load('deliveryInformation', 'category', 'galleries');

        // Return the product instance with its related models
        return response()->json(['product' => $product], 200);
    }

    public function updatePhaseOne(Request $request, Product $product)
    {
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
        //Status
        $product->publish_status = 'En revisión';
        //SKU
        $product->sku = $this->generateSKU($request->input('stepOneCategoryProduct.name'));
        //Slug
        $slug = Str::slug($product->name,'-')."-";
        $slug .= Carbon::now()->timestamp;
        $product->slug = $slug;

        $product->save();

        // Retrieve the delivery information associated with the product
        $deliveryInformation = DeliveryInformation::where('product_id', $product->id)->first();

        // If delivery information does not exist, create a new instance
        if (!$deliveryInformation) {
            $deliveryInformation = new DeliveryInformation();
            $deliveryInformation->product_id = $product->id;
        }

        //Dimensiones Producto Embalado
        $deliveryInformation->length = $request->input('stepThreeLength');
        $deliveryInformation->length_unit = $request->input('stepThreeLengthUnit');
        $deliveryInformation->width = $request->input('stepThreeWidth');
        $deliveryInformation->width_unit = $request->input('stepThreeWidthUnit');
        $deliveryInformation->height = $request->input('stepThreeHeight');
        $deliveryInformation->height_unit = $request->input('stepThreeHeightUnit'); 
        $deliveryInformation->weight = $request->input('stepThreeWeight');
        $deliveryInformation->weight_unit = $request->input('stepThreeWeightUnit');

        // Check if weight unit is in grams ("g") and convert to kilograms ("kg")
        if ($request->input('stepThreeWeightUnit') === 'g') {
            // Divide weight by 1000 to convert grams to kilograms
            $deliveryInformation->weight /= 1000;
            // Change weight unit to kilograms
            $deliveryInformation->weight_unit = 'Kg';
        }

        // Save or update the delivery information
        $deliveryInformation->save();

        return response()->json(['message' => 'Product phase 1 uploaded successfully']);
    }

    public function getSlug(Product $product)
    { 
        // Return the product instance with its related models
        return response()->json(['slug' => $product->slug], 200);
    }

    public function destroyImage($id)
    {
        // Find the product gallery entry by ID
        $productGallery = ProductGallery::findOrFail($id);
    
        // Construct the absolute file path
        $filePath = public_path($productGallery->url);
    
        // Delete the image file from the server if it exists
        if (File::exists($filePath)) {
            File::delete($filePath);
        } else {
            // Log a warning if the file is not found
            Log::warning('File not found:', ['path' => $filePath]);
        }
    
        // Delete the product gallery entry
        $productGallery->delete();
    
        return response()->json(['message' => 'Image deleted successfully'], 200);
    }

    public function getGenders()
    {
        $genders = Gender::get();

        return response()->json($genders);
    }
}
