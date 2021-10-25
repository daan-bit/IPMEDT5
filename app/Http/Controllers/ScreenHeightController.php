<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScreenHeight;

class ScreenHeightController extends Controller
{
    public function show()
    {
        $data =  screenHeight::all();
        return view('afstanden.screenHeight',[
            "afstanden"=> $data,
            "gemiddelde" => $data = screenHeight::all()->avg('Afstand'),
        ]);
    }
}

