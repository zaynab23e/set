<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\loginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthUserController extends Controller
{

public function registers(RegisterUserRequest $request){
    $validatedData= $request->validated();
$user=User::create([
    'name'    => $validatedData['name'],
    'email'   => $validatedData['email'],
    'password'=> Hash::make($validatedData['password']),
]);
$user->createToken('api of token'.$user->name)->plainTextToken;
return response()->json(['msg'.'successfully']);

}


    public function loginus(loginUserRequest $request){
$validatedData= $request->validated();

$user=User::where("email" , $request->input( "email"))->first();
if(!$user || !Hash::check($request->input('password'),$user->password)){
return response()->json(['msg'.'error']);
}

$token = $user->createToken('Api of token  ' . $user->name)->plainTextToken;
return response()->json([$token]);
    }

    

public function logout(){
    $user=Auth::user();
    if(!$user){
        return response()->json(['msg'.'error']);
    };
    $user->currentAccessToken()->delete();
    return response()->json(['msg'.'deleted successfully']);
}


}
