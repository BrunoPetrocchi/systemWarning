<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Token;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Criar um LoginRequest
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Login ou senha inválido'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout(Request $request)
    {

        if (Auth::check()) {
            $request->user()->currentAccessToken()->delete();
            return response()->json(['success' =>'Logout Realizado com sucesso'],200);
        }else{
            return response()->json(['error' =>'OPS! algo deu errado'], 500);
        }

    }
}
