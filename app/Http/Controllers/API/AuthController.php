<?php

namespace App\Http\Controllers\API;
use Auth;
use Validator;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request){
        //Validation
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'passwordr' => 'required',
        ]);
        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 400);
        }
        $input = $request->all();
        $input["password"] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] = $user->createToken('Myapp')->plainTextToken;
        $success['name'] = $user->name;

        $response = [
            'success' => true,
            'data' => $success,
            'message' => 'User Register Successfully'
        ];

        return response()->json($response, 200);
    }

    public function login(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] = $user->createToken('Myapp')->plainTextToken;
            $success['name'] = $user->name;
            
            $response = [
            'success' => true,
            'data' => $success,
            'message' => 'Login Successfully'
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'success' => false,
                'message' => 'Unauthorised'
            ];
            return response()->json($response, 200);
        }
        
    }
}
