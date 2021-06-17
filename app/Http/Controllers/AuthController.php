<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = new User();
        $user->email = $request->input('email');
        $user->name = $request->input('name');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return $user;
    }

    public function login(Request $request)
    {
        $credenciais = $request->all(['email', 'password']);

        $token = auth('api')->attempt($credenciais);

        if ($token) {
            return response()->json(['token' => $token]);
        }

        return response()->json(['erro' => 'Usuário inválido'], 403);
    }

    public function logout()
    {
        return 'logout';
    }

    public function refresh()
    {
        return 'refresh';
    }

    public function me()
    {
        return response()->json(auth()->user()->name);
    }
}
