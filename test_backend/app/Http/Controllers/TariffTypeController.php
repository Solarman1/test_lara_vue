<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TariffType;

class TariffTypeController extends Controller
{
    //
    public function index(){
        $dat = TariffType::all();
    
        return $dat;
    }
}
