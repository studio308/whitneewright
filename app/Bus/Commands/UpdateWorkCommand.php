<?php

namespace App\Bus\Commands;

use App\Categories;
use Illuminate\Support\Facades\DB;

class UpdateWorkCommand
{
    protected $work;

    protected $title;

    protected $selectedCategory;

    protected $price;

    protected $dimensions;

    protected $description;

    public function __construct($work, $title, $selectedCategory, $price, $dimensions, $description)
    {
        $this->work = $work;
        $this->title = $title;
        $this->selectedCategory = $selectedCategory;
        $this->price = $price;
        $this->dimensions = $dimensions;
        $this->description = $description;

    }

    public function getWork()
    {
        return $this->work;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getSelectedCategory()
    {
        return $this->selectedCategory;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getDimensions()
    {
        return $this->dimensions;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function handle()
    {
        return DB::transaction(function() {

            $work = $this->work;
            $work->title = $this->title;
            $work->category_id = $this->selectedCategory;
            $work->price = $this->price;
            $work->measurements = $this->dimensions;
            $work->description = $this->description;
            $work->alias = str_slug($this->title);

            $work->save();

        });
    }
}