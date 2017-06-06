<?php

namespace App\Bus\Commands;

use App\Event;
use Illuminate\Support\Facades\DB;

class AddEventCommand
{
    protected $title;

    protected $description;

    protected $location;

    protected $startDate;

    protected $endDate;

    protected $startTime;

    protected $endTime;

    protected $image;

    public function __construct($title, $description, $location, $startDate, $endDate, $startTime, $endTime, $image)
    {
        $this->title = $title;
        $this->description = $description;
        $this->location = $location;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->image = $image;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getLocation()
    {
        return $this->location;
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

    public function getImage()
    {
        return $this->image;
    }

    public function handle()
    {
        $workAsdf = '';
        return DB::transaction(function() use ($workAsdf) {
            $event = Event::create([
                'title' => $this->title,
                'description' => $this->description,
                'location' => $this->location,
                'start_at' => $this->startDate,
                'end_at' => $this->endDate,
                'start_time' => $this->startTime,
                'end_time' => $this->endTime,
                'path' => $this->image,
                'alias' => str_slug($this->title)
            ]);

            return $event;
        });
    }
}