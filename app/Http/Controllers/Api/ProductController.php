<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BankDetail;
use App\Models\DeliveryInformation;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
            $name = preg_replace('/[^\w\d\.\-_]/', '_', $name) . '.png';           


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

    public function getProductsByUserId($user_id)
    {
        // Assuming you have a 'products' table with a 'user_id' column
        $products = Product::where('user_id', $user_id)->get();

        return response()->json($products);
    }


    


}
