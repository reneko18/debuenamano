<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellingFormController extends Controller
{
    public function showform()
    {
        return view('selling.form');
    }

    public function show()
    {
        return view('selling.form');
    }
}
