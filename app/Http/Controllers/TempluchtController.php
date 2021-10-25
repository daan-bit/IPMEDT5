<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use DB;

class TempluchtController extends Controller
{
    public function show(){ 
        return view('templucht.templucht',[
            'cur' => \App\Models\TemperatureHumidity::latest()->first(),
            'avgTemp' => \App\Models\TemperatureHumidity::avg('temperature'),
            'avgHum' => \App\Models\TemperatureHumidity::avg('humidity'),
            'sum' => \App\Models\TemperatureHumidity::all(),
            'pref' => \App\Models\UserPrefer::first()
        ]);

    }

    public function store(Request $request, \App\Models\UserPrefer $prefer){
        DB::table('userpreferences')->truncate();
        $prefer->age = $request->input('age');
        $prefer->gewensttemp = $request->input('gewensttemp');
        $prefer->gewensthum = $request->input('gewensthum');

       try{
           $prefer->save();
           return redirect('/templucht');
       }
       catch(Exception $e){
           return redirect('/templucht');
       }



       

    }
}
