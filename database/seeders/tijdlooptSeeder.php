<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class tijdlooptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tijdloopt')->insert([
            'name' => 'Tijdhardware',
            'active' => 0 ,
        ]);
    }
}
