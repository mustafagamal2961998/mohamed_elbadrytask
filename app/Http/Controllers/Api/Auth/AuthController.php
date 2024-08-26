<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $credentials = request(['email', 'password']);  
        if (!Auth::attempt($credentials)) {
                return response()->json([
                   'data'=>[
                    'message'=>'Login is faild'
                    ],
                    'statusCode'=>422
                ]);
        }
        
        $user = User::where('email',$request->email)->first();
         
                
        $token = $user->createToken('authToken')->plainTextToken;
 
        return response()->json(['data'=>[
            'access_token' => $token, 
            'token_type' => 'Bearer',
            'user_data'=> new UserResource($user),
        ],'statusCode'=>200]);
    }

    public function register(RegisterRequest $request){
        $request->merge(['password'=>Hash::make($request->password)]);
        $store = User::create($request->all());
        $token = $store->createToken('authToken')->plainTextToken;
        return response()->json(['data'=>[
            'access_token' => $token, 
            'token_type' => 'Bearer',
            'user_data'=> new UserResource($store),
        ],'statusCode'=>200]);
    }
}