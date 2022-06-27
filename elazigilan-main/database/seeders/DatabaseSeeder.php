<?php

namespace Database\Seeders;

use App\Models\SiteSettings;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        /*SiteSettings::create([
            'tags' => 'Elazığ İlan',
            'title' => 'Elazığ İlan',
            'page_title' => 'Elazığ İlan',
            'description' => 'Elazığ İlan'
        ]);*/


        $faker = Faker::create();

        foreach (range(1,500) as $index) {
            DB::table('ads')->insert([
                'title' => $faker->firstname,
                'description' => $faker->lastname,
                'contact' => $faker->email,
                'views' => 0
            ]);
        }

    }
}
