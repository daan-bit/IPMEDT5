<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nietstoren;



class LedController extends Controller 
{
    public function aanuit()
    {
        $niet_storen = Nietstoren::all()->first();

        if ($niet_storen->led_on == 'uit')
        {
            $niet_storen->led_on = 'aan';
        }
        else
        {
            $niet_storen->led_on = 'uit';
        }
        $niet_storen->save();
        return redirect('/decibel');
    }
}