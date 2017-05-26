<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Media;
use App\Work;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $categories = Categories::all();
        View::share('categories', $categories);
    }
}