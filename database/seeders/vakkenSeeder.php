<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class vakkenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vakken')->insert([
            'naam' => 'IBK6',
            'benodigetijd' => 60 ,
            'gewerktetijd' => 15,
        ]);
        DB::table('vakken')->insert([
            'naam' => 'ICOMHA',
            'benodigetijd' => 120 ,
            'gewerktetijd' => 0,
        ]);
        DB::table('vakken')->insert([
            'naam' => 'IARCH',
            'benodigetijd' => 120 ,
            'gewerktetijd' => 80,
        ]);
    }
}


