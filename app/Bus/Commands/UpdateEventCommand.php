<?php

namespace App\Bus\Commands;

use App\Categories;
use Illuminate\Support\Facades\DB;

class UpdateEventCommand
{
    protected $event;

    protected $title;

    protected $description;

    protected $location;

    protected $startDate;

    protected $endDate;

    protected $startTime;

    protected $endTime;

    public function __construct($event, $title, $description, $location, $startDate, $endDate, $startTime, $endTime)
    {
        $this->event = $event;
        $this->title = $title;
        $this->description = $description;
        $this->location = $location;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->startTime = $startTime;
        $this->endTime = $endTime;

    }

    public function getEvent()
    {
        return $this->event;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function getEndDate()
    {
        return $this->endDate;
    }

    public function getStartTime()
    {
        return $this->startTime;
    }

    public function getEndTime()
    {
        return $this->endTime;
    }

    public function handle()
    {
        $asdf = '';
        return DB::transaction(function() use ($asdf) {

            $event = $this->event;
            $event->title = $this->title;
            $event->description = $this->description;
            $event->start_at = $this->startDate;
            $event->end_at = $this->endDate;
            $event->location = $this->location;
            $event->start_time = $this->startTime;
            $event->end_time = $this->endTime;
            $event->alias = str_slug($this->title);

            $event->save();

        });
    }
}