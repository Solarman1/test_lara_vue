<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Order;
use App\Services\Interfaces\OrderRegisterServiceInterface;

class OrderRegisterController extends Controller
{
    protected $clientModel;
    protected $orderModel;

    public function __construct()
    {
        $this->clientModel  = new Client;
        $this->orderModel   = new Order;
    }

    public function registerOrder(OrderRegisterServiceInterface $register_service, Request $request)
    {
        $result = $register_service->registerClientOrder($this->clientModel, $this->orderModel, $request);

        if($result)
            return response('ok, the order has been created', 200);
        else
            return response('not ok', 500);
    }
}