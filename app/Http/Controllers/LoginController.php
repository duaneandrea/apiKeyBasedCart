<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);
        if (!auth()->attempt($loginData)) {
            return $this->jsonError(401, "Invalid credentials");
        }
        // $accessToken = auth()->user()->createToken('authToken')->accessToken;
        $user = Auth::user();
        // $accessToken = $user->createToken('authToken', ['server:access'])->plainTextToken;
        $accessToken = $user->createToken('authToken', ['server:access'])->plainTextToken;
        return response(['user' => new UserResource(auth()->user()), 'token' => $accessToken, 'success' => true, 'message' => 'Logged in successfully']);
    }


    public function logout(Request $request)
    {
        //this deletes the token for the user
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }
}
