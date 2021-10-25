<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class noodgevalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stop')->insert([
            'stop_on' => 'Uit'
        ]);
    }
}
