<?php

namespace App\Http\Controllers\Api\SocialNetwork;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class FacebookApiController extends ApiController
{
    public function hook(Request $request){
        logger($request->all());
        return $this->responseSuccess();
    }
}
