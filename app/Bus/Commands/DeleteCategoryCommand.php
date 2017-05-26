<?php

namespace App\Bus\Commands;

use App\Categories;
use Illuminate\Support\Facades\DB;

class DeleteCategoryCommand
{
    protected $category;

    public function __construct(Categories $category)
    {
        $this->category = $category;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function handle()
    {
        $category = $this->category;
        return DB::transaction(function() use ($category) {

            $category->delete();

        });
    }
}