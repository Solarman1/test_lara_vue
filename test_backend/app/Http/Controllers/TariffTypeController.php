<?php

namespace App\Http\Controllers;

use App\Models\TariffType;

class TariffTypeController extends Controller
{
    //
    public function index(){
        $dat = TariffType::all();
    
        return $dat;
    }
}
