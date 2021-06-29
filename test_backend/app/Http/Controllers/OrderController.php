<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    //
    public function save(Request $request)
    {
        $data = json_decode($request->getContent());
        Order::create($data);
    }
}
