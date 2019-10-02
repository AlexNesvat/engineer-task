<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscribeRequest;

class SubscribeController extends Controller
{

    public function subscribe(SubscribeRequest $request)
    {
        $data = $request->all();


    }
}
