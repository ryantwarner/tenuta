<?php

use Illuminate\Database\Seeder;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Location::class, 5)->create()->each(function ($l) {
            $l->units()->save(factory(\App\Models\Unit::class)->make());
        });
    }
}
