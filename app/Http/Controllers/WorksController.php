<?php

namespace App\Http\Controllers;

use App\Category;
use App\Work;
use Illuminate\Http\Request;

use App\Http\Requests;

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

        return view('works.show')->with('work', $work);
    }
}
