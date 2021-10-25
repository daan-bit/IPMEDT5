<?php

namespace App\Http\Controllers;
use App\Models\werk;
use Illuminate\Http\Request;
use DB;

class aanhetwerkController extends Controller
{   
    public function newvak(Request $request, \App\Models\werk $werk){
        DB::table('tijdloopt')->truncate();
        $werk->name = $request->input('werkvak');
        $werk->active = true;
        
        try{
            $werk->save();
            return redirect('/vakken');
        }
        catch(Exception $e){
            return redirect('/vakken');
        }
    }
    
}
