<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoodgevalController extends Controller
{
    public function aanuit(){
        $stop = \App\Models\Stop::first();

        if($stop->stop_on == 'uit'){
            $stop->stop_on = 'aan';
        }
        else{
            $stop->stop_on = 'uit';
        }
        $stop->save();

        return view('Telefoon.stop', ['stop' => $stop->stop_on]);
    }
}
