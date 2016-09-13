<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoriesController extends Controller
{
    public function show($categories)
    {
        $category = Categories::whereAlias($categories)->first()->works->all();

        return view('works')->with('category', $category);

    }
}
