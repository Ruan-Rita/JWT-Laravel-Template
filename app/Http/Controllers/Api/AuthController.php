<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try{
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
            $token = Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']]);
            if (!$token ) {
                return response()->json([
                    'error' => 'Unauthorized',
                ], 401);
            }

            return $this->respondWithToken($token);
        }catch(Exception $error){
            Log::error("error: {$error}");
            return response()->json($error, 500);
        }
    }
    public function register(){

    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }
}
