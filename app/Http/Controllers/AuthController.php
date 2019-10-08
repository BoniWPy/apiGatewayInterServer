<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function login(Request $request){
        
        
        $login  = \App\Secret::whereRaw("api_keys = ?", [$request->secret_keys])->first();
        // $login = Secret::select('*')->where('api_keys', [$request->secret_keys])->get();
       

        if( !$login ){
            return response()->json([
                "message"   => "gagal di auth"
            ],400);
        }
        
        
        $session=false;
        do{

            $rand = $this->random(8).":".$this->random(64);

            $session_exists = \App\Secret::whereRaw("token",[ $rand ])->first();

            if(!$session_exists) $session = $rand;
        }while(!$session);

        $login->token = $session;
        return "token";
        

        if($login->save()){
            return response()->json([
                "token" => $session
            ],201);
        }else{
            return response()->json([
                "message"   => "Unauthorized"
            ],401);
        }

    }
}
