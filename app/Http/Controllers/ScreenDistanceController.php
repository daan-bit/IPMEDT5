<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScreenDistance;
class ScreenDistanceController extends Controller
{
    public function show()
    {
        $data =  ScreenDistance::all();
        return view('afstanden.screenDistance',[
            "afstanden"=> $data,
            "gemiddelde" => $data = ScreenDistance::all()->avg('Afstand'),
            ]);
    }
}
