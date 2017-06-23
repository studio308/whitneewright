<?php

namespace App\Http\Controllers\Api;

use App\Bus\Commands\AddEventCommand;
use App\Bus\Commands\UpdateEventCommand;
use App\Event;
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

    public function update()
    {
        try {
            $updateEvent = Input::all();
            $eventId = array_get($updateEvent, 'id');
            $event = Event::findorfail($eventId);
            //dd($updateEvent);
            $this->dispatchNow(new UpdateEventCommand(
                $event,
                array_get($updateEvent, 'title'),
                array_get($updateEvent, 'description'),
                array_get($updateEvent, 'location'),
                array_get($updateEvent, 'startDate'),
                array_get($updateEvent, 'endDate'),
                array_get($updateEvent, 'startTime'),
                array_get($updateEvent, 'endTime')
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