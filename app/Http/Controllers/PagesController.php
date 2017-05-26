<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Routing\Controller;

class PagesController extends Controller
{
    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
}
