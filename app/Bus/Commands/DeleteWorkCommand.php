<?php

namespace App\Bus\Commands;

use App\Categories;
use Illuminate\Support\Facades\DB;

class DeleteWorkCommand
{
    protected $work;

    public function __construct($work)
    {
        $this->work = $work;
    }

    public function getWork()
    {
        return $this->work;
    }

    public function handle()
    {
        $asdf = '';
        return DB::transaction(function() use ($asdf) {

            $work = $this->work;
            
            $work->delete();

        });
    }
}