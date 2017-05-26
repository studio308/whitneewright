<?php

namespace App\Bus\Commands;

use App\Categories;
use Illuminate\Support\Facades\DB;

class AddCategoriesCommand
{
    protected $categories;

    public function __construct(array $categories)
    {
        $this->categories = $categories;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function handle()
    {
        $categories = $this->categories;
        return DB::transaction(function() use ($categories) {
        foreach($categories as $category) {
                $categoryName = ucwords($category["name"]);
                $createCategory = Categories::create([
                    'alias' => $categoryName,
                    'name' => str_slug($categoryName)
                ]);
            }

            return $categories;

        });
    }
}