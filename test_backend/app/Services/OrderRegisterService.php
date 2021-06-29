<?php

namespace App\Services;

use App\Services\Interfaces\OrderRegisterServiceInterface;
use Illuminate\Support\Facades\DB;
use Exception;
use Message;

class OrderRegisterService implements OrderRegisterServiceInterface
{
    public function registerClientOrder($clientModel, $orderModel, $request)
    {
        DB::beginTransaction();

        //$data = json_decode($request->getContent());
        $check = $clientModel::select('id')->where('phone', $request->phone)
                ->first();
         
        if(!$check)
        {
            $clientId = $clientModel::create([
                'name'  =>  $request->name,
                'phone' =>  $request->phone 
            ]);
   
            try{
                $this->saveOrder($orderModel, $request, $clientId);
                DB::commit();
                return true;
            }
            catch(Exception $e)
            {
                DB::rollBack();
                return $e->getMessage();
            }
        }
        else
        {
            try{
                $this->saveOrder($orderModel, $request, $check);
                DB::commit();
                return true;
            }
            catch(Exception $e)
            {
                DB::rollBack();
                return $e->getMessage();
            }
        }
        return false;
    }

    private function saveOrder($orderModel, $data, $clientId)
    {
        $orderModel::create([
            'client_id'             => $clientId['id'],
            'tariff_id'             => $data->tariffId,
            'adress'                => $data->adress,
            'first_delivery_day'    => $data->firstDeliveryDay
        ]);
    }
}