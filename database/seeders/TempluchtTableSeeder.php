<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class TempluchtTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($x = 0; $x < 12; $x++) {
            DB::table('templucht')->insert([
                'temperature' => rand(19,21),
                'humidity' => rand(49,52)
            ]);
            
        }
    }
}
