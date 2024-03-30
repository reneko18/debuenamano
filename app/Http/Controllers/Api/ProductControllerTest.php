<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeliveryInformation;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductControllerTest extends Controller
{
    public function storePhaseOne(Request $request)
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

        return response()->json(['message' => 'Product phase 1 uploaded successfully']);
    }

    public function storePhaseTwo(Request $request)
    {
        //Add logic for this method
    }
}
