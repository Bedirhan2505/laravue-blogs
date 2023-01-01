<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request){
        //Validation
        $validator = Validation::make($request->all(),[
            'name' => 'reuqired',
            'email' => 'reuqired',
            'password' => 'reuqired',
            'passwordr' => 'reuqired',
        ]);
        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 400);
        }
    }
}
