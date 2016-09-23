<?php

use Illuminate\Database\Seeder;

class MediasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Media::class, 5)->create()->each(function($w) {
            $w->works()->save(factory(App\Work::class)->make());
        });
    }
}
