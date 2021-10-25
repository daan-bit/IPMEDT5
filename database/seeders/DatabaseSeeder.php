<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            tijdlooptSeeder::class,
            vakkenSeeder::class,
            inputtimeSeeder::class,
            checkAanwezigTableSeeder::class,
            noodgevalTableSeeder::class,
            TempluchtTableSeeder::class,
            UserPreferencesTableSeeder::class,
            DecibelTableSeeder::class,
            NietStorenTableSeeder::class,
            ScreenDistanceTableSeeder::class,
            ScreenHeightDistanceTableSeeder::class,
            DeskDistanceTableSeeder::class,
            
        ]);
    }
}
