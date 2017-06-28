<?php

namespace App\Bus\Commands;

use App\Categories;
use Illuminate\Support\Facades\DB;

class DeleteEventCommand
{
    protected $event;

    public function __construct($event)
    {
        $this->event = $event;
    }

    public function getEvent()
    {
        return $this->event;
    }

    public function handle()
    {
        return DB::transaction(function() {

            $event = $this->event;

            $event->delete();

        });
    }
}