<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthAPIController extends Controller
{
    function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => ['required', 'unique:users'],
            'password' => 'required'
        ]);

        User::create([
            'name' => $request -> name,
            'email'  => $request -> email,
            'password' => bcrypt($request->password)
        ]);

        return response('Registered Success.', 201);;
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response(['message' => 'The credentials you provided do not match'], 401);
    }
    $token = $user->createToken($user->email)->plainTextToken;

    return response(['token' => $token], 200);
}
public function logout(Request $request)
{
    // Ensure the user is authenticated
    if (!$request->user()) {
        return response(['message' => 'Unauthenticated.'], 401);
    }

    $request->user()->currentAccessToken()->delete();
    return response('Logout Success', 200);
}
}
