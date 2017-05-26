<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Routing\Controller;

class EventsController extends Controller
{
    public function index()
    {
        $events = Event::all();

        return view('events.events')->with($events, 'events');

    }

    public function show(Request $request)
    {

    }
}
