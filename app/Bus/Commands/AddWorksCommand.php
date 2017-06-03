<?php

namespace App\Bus\Commands;

use App\Categories;
use App\Media;
use App\Work;
use Illuminate\Support\Facades\DB;

class AddWorksCommand
{
    protected $title;

    protected $selectedCategory;

    protected $price;

    protected $dimensions;

    protected $description;

    protected $images;

    protected $primaryPhoto;

    public function __construct($title, $selectedCategory, $price, $dimensions, $description, array $images, $primaryPhoto)
    {
        $this->title = $title;
        $this->selectedCategory = $selectedCategory;
        $this->price = $price;
        $this->dimensions = $dimensions;
        $this->description = $description;
        $this->images = $images;
        $this->primaryPhoto = $primaryPhoto;
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

    public function getImages()
    {
        return $this->images;
    }

    public function getPrimaryPhoto()
    {
        return $this->primaryPhoto;
    }

    public function handle()
    {
        $workAsdf = '';
        return DB::transaction(function() use ($workAsdf) {
            $work = Work::create([
                'title' => $this->title,
                'category_id' => $this->selectedCategory,
                'description' => $this->description,
                'price' => $this->price,
                'measurements' => $this->dimensions,
                'alias' => str_slug($this->title)
            ]);
            $images = $this->images;
            foreach($images as $image) {
                if($image['name'] == $this->primaryPhoto) {
                    $primary = 1;
                } else {
                    $primary = 0;
                }
                $media = Media::create([
                    'title' => $image['name'],
                    'work_id' => $work->id,
                    'path' => $image['path'],
                    'primary' => $primary
                ]);
            }

            return $work;
        });
    }
}