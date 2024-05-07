<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    // Criar um LoginRequest
    public function registeruser(Request $request, User $user){

        $request->validate([
            'email' => 'required|email|unique:users,email,'.$user->id,
        ]);

        $userData = $request->only('name','email','password');
        $userData['password'] = bcrypt($userData['password']);

        if (!$user = $user->create($userData))
            abort(500,"Error create");

        return response()
            ->json([
                'user' => ['data' => $user,]
            ]);
    }
}
