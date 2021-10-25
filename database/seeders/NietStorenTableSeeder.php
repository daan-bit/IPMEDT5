<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class NietStorenTableSeeder extends Seeder
{
        /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        DB::table('niet_storen')->insert([
            'led_on' => 'uit'
        ]);
    }
}
