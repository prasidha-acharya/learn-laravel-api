<?php

namespace App\Http\Controllers;

use App\Http\Requests\Register;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //

    public function register(Register $request){
        
     $validatedData = $request->validated();

      $user =  User::create([
        'name' =>$validatedData['name'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password'])
        ]);

      $token = $user -> createToken('token','[*]',now()->addDay())->plainTextToken;

      return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);

    }

public function login(Request $request)
{
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'Invalid email or password',
        ], 401);
    }

    $user->tokens()->delete();

    $token = $user->createToken('token', ['*'], now()->addDay())->plainTextToken;

    return response()->json([
        'token' => $token,
    ]);

}
}
