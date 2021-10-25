<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class UserPreferencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('userpreferences')->insert([
            'age' => 20,
            'gewensttemp' => 21,
            'gewensthum' => 50
        ]);
    }
}
