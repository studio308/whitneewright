<?php

namespace App\Http\Controllers;

use App\Work;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Routing\Controller;

class WorksController extends Controller
{

    public function index()
    {
        $works = Work::all();

        return view('works.works')->with('works', $works);
    }

    public function show($workAlias)
    {
        $work = Work::whereAlias($workAlias)->first();
        //dd($work);
        return view('works.show')->with('work', $work);
    }
}
