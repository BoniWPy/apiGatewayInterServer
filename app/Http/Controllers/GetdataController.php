<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use  App\User;


class GetdataController extends Controller
{

    public function postdata(Request $request){
         
            $data = new User;
            $data->name = $request->input('name');
            $data->mobile = $request->input('mobile');
            $data->email = $request->input('email');
            $data->otp = $request->input('otp');
            if($data->save()){
            

            //return successful response
            return response()->json(['user' => $data, 'message' => 'OK'], 201);

        } else  {
            //return error message
            return response()->json(['message' => 'Post Data Failed!'], 409);
        }
         

    }

    public function test(){
        return "MANTAPs BRow";
    }

    public function unauthorized(){
        return response()->json(['message' => 'unauthorized'], 409);
    }
}
