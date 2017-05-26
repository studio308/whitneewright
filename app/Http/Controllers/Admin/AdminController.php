<?php

namespace App\Http\Controllers\Admin;


use App\Categories;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.index')->with('page', 'index');
    }

    public function categories()
    {
        $categories = Categories::all();
        return view('admin.categories')->with('page', 'categories')->with('categories', $categories);
    }
}