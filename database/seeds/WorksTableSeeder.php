<?php

use Illuminate\Database\Seeder;

class WorksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Work::class, 5)->create()->each(function($w) {
            $w->categories()->save(factory(App\Category::class)->make());
        });
    }
}
