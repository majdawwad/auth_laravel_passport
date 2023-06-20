<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name'=>'required|max:255',
            'email'=>'required|unique:users|max:255',
            'password'=>'required|min:6'
        ]);

        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        $token=$user->createToken('auth_token')->accessToken;

        return response()->json([
            'messege'=>'success, User has been created successfully',
            'token'=>$token
        ]);

    }

    public function login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        $user=User::where('email',$request->email)->first();

        if(!$user|| !Hash::check($request->password,$user->password)){
            return response()->json([
                'message'=>'The provided credentials are incorrect'
            ]);
        }

        $token=$user->createToken('auth_token')->accessToken;

        return response()->json([
            'user'=>$user,
            'token'=>$token
        ]);


    }

    public function logout(Request $request){
        $request->user()->token()->revoke();

        return response()->json([
            'message'=>'Logged out successfully'
        ]);
    }
}
