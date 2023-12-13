<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::withCount(['posts' => function ($query) {
            $query->withPostFilters(
                request()->input('authors', []),            
                request()->input('postcategories', []),              
            );
        }])->get();       
    
        return response()->json($authors);
    }
}
