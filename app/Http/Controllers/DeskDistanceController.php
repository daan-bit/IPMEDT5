<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeskDistance;
class DeskDistanceController extends Controller
{
    public function show()
    {
        $data =  deskDistance::all();
        return view('afstanden.deskDistance',[
            "afstanden"=> $data,
            "gemiddelde" => $data = deskDistance::all()->avg('Afstand'),
        ]);
    }
}
