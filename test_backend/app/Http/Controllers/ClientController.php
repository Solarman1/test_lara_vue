<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    //
    public function save(Request $request)
    {
        $data = json_decode($request->getContent());
        $check = Client::where('phone', $data->phone)
                ->get();
        
        if(!$check)
            $save = Client::create($data);
        else
            $this->update($data);
        
        return response($save->id, 200);
    }

    public function update($data)
    {
        $article = Client::findOrFail($data->id);
        $article->update($data);
    }
}
