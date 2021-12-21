<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Validation\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return $request->user();
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed',
        ]);

        $result = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);

        return $result;
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if(Auth::attempt($credentials))
        {
            $user = Auth::user();
            $token = md5( time() ).'.'.md5($request->email);
            $user->forceFill([
                'api_token'=>$token,
            ])->save();
            return response()->json([
                'token'=>$token
            ]);
        }

        return response()->json([
            'message'=>'The provide credentials do not match our records.'
        ],401);
    }

    public function logout(Request $request)
    {
        $request->user()->forcefill([
            'api_token'=>null,
        ])->save();

        return response()->json(['message'=>'succes']);
    }

    public function update(Request $request){
        $request->validate([
            'name'=>'required',
        ]);

        $request->user()->forcefill([
            'name'=>$request->name,
        ])->save();

        return response()->json(['message'=>'succes']);

    }

    public function changePassword(Request $request){
        $request->validate([
            'new_password'=>'required',
            'old_password'=>'required',
        ]);

        if(password_verify($request->old_password, $request->user()->password)){
            $request->user()->forcefill([
                'password'=>bcrypt($request->new_password),
            ])->save();
    
            return response()->json(['message'=>'succes']);
        }
        return response()->json([
            'message'=>'The provide credentials do not match our records.'
        ],401);
    }

    public function destroy(Request $request){
        $user = $request->user();
        $user->forceDelete();
        return response()->json(['message'=>'succes']);
    }

    public function errorMessage($error_code, $message){
        return response()->json([
            'success' => $error_code,
            'message' => $message
        ]);
    }

    public function errorMessageWithData($error_code, $message, $data){
        return response()->json([
            'success' => $error_code,
            'message' => $message,
            'user' => $data
        ]);
    }
}
