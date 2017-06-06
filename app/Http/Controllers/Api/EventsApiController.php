<?php

namespace App\Http\Controllers\Api;

use App\Bus\Commands\AddEventCommand;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Routing\Controller;
use App\Http\Controllers\Api\AbstractApiController;
use Illuminate\Support\Facades\Input;

class EventsApiController extends AbstractApiController
{
    public function store(Request $request)
    {
        try {
            $event = Input::all();
            $imagePath = array_get($event, 'image')['path'];

            $this->dispatchNow(new AddEventCommand(
                array_get($event, 'title'),
                array_get($event, 'description'),
                array_get($event, 'location'),
                array_get($event, 'startDate'),
                array_get($event, 'endDate'),
                array_get($event, 'startTime'),
                array_get($event, 'endTime'),
                $imagePath
            ));

            return 'yaoo';

        } catch(ValidationException $e) {

            return "that didn't work";
        }
    }

    public function delete()
    {

        try {


        } catch(ValidationException $e) {


        }
    }
}