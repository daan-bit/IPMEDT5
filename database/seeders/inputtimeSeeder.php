<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class inputtimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inputtime')->insert([
            'naam' => 'timer',
            'ingesteldetijd' => 0 ,
        ]);
    }
}

