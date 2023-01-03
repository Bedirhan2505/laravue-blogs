<?php

namespace App\Http\Controllers\API;
use Auth;
use Validator;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use App\Mail\MailResetPassword;

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
            $success['token'] = $user->createToken('Login-Token')->plainTextToken;
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
    public function resetpassword(Request $request){

        $user = User::all()->where('email', $request->email)->where('name', $request->name)->first();
        $rast = rand(1000,10000000);
        $data = array();
        if($user){
            array_push($data,$user,$rast);
            Mail::to($user->email)->send(new MailResetPassword($data));
            $success = array();
            array_push($success,$rast,$user->email);
            $response = [
                'success' => true,
                'data' => $success,
                'message' => 'Reset Password Succcssfuly'
                ];
            return response()->json($response, 200);
        } else {
            $response = [
                'success' => false,
                'message' => 'Reset Password Error ! No Account..'
                ];
            return response()->json($response, 200);
        }
        
    }
    public function respasstwostep(Request $request){

        $user = User::all()->where('email', $request->email)->first();
        if ( $request->password != '')
        {
            if($request->password == $request->passwordr){
                $user->password = bcrypt($request->password);
                $user->save();
                $response = [
                    'success' => true,
                    'message' => 'Reset Password Succcssfuly'
                ];
                return response()->json($response, 200);
            }
        
        }       
        
    }
}
