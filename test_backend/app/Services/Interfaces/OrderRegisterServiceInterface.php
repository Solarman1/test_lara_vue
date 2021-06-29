<?php

namespace App\Services\Interfaces;

interface OrderRegisterServiceInterface
{
    public function registerClientOrder($clientModel, $orderModel, $request);
}