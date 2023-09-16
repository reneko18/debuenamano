<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(Region $region)
    {
        $cities = $region->cities;
        return response()->json($cities);
    }
}
