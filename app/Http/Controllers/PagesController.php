<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function inicio()
    {
        return view('inicio');
    }
    public function nosotros()
    {
        return view('nosotros');
    }

    public function terms()
    {
        return view('others.terms_conditions');
    }

    public function landing()
    {
        return view('landing.index');
    }
}
