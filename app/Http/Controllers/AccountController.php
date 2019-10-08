<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class AccountController extends Controller
{

    public function account_detail(Request $request){

        $user = \App\Secret::WhereRaw("token = ?",[ $request->header("Authorization") ])->first();
        
        return $user;

    }

    public function test(){
        return "MANTAPs BRow";
    }
}
