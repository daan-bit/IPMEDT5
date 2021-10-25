<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class checkAanwezigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('check_aanwezig')->insert([
            'aanwezig' => 'Niet',
        ]);
    }
}
