<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function store(Request $request)
    {
        $test = new Test();
        $test->name = $request->input('stepOneName');
        $test->category = $request->input('stepOneCategory');
        $test->genre = $request->input('stepOneGenre');
        $test->ageini = $request->input('stepOneAgeIni');
        $test->agedateini = $request->input('stepOneAgeDateIni');
        $test->agefin = $request->input('stepOneAgeFin');
        $test->agedatefin = $request->input('stepOneAgeDateFin');
        $test->save(); 
    }
}
