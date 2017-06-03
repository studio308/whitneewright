<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Media;
use App\Work;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Routing\Controller;

class CategoriesController extends Controller
{
    public function show(Request $request)
    {
        $alias = $request->segments();
        $category = Categories::whereAlias($alias)->first()->works;
        dd($category);
        return view('categories.show')->with('category', $category);

    }

    public function showByAlias(Request $request)
    {
        $name = $request->segments();

        $category = Categories::where('name', $name)->first();

        return view('categories.show')->with('category', $category);
    }
}
