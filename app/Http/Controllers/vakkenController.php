<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

class vakkenController extends Controller
{
    public function index(){
        return view('vakken.index',['vakken' => \App\Models\vak::all(), 'inputtime' => \App\Models\inputtime::first()]);
    }

    public function store(Request $request, \App\Models\vak $vakken){
        
        $vakken->naam = $request->input('naam');
        $vakken->benodigetijd = $request->input('benodigetijd');
        $vakken->save();
        try{
            return redirect('/vakken');
        }
        catch(Exception $e){
            return redirect('/vakken');
        }
        
        
    }


}
