<?php

namespace App\Bus\Handlers\Commands;

use App\Bus\Commands\AddCategoriesCommand;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;

class AddCategoriesCommandHandler
{
    use DispatchesJobs;

    public function handle(AddCategoriesCommand $command)
    {
        $categories = $command->getCategories();
        dd($categories);
        return DB::transaction(function() use ($categories) {


        });
    }
}