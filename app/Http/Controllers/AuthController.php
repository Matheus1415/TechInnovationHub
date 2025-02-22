<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Login do usuário e geração do token via Sanctum
    public function login(Request $request)
    {
        try {
            if (auth()->check()) {
                return redirect('/');
            }

            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $credentials = $request->only('email', 'password');
            
            if (!Auth::attempt($credentials)) {
                return response()->json([
                    "message" => "Ops, parece que seu e-mail ou senha estão incorretos."
                ], 401);
            }

            $user = Auth::user();
            $token = $user->createToken('access-token')->plainTextToken;

            return response()->json([
                "message" =>"Usúario logado",
                'token' => $token,
                'token_type' => 'bearer',
                'expires_in' => null 
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Ocorreu um erro na sua autenticação.',
                'message' => env('APP_ENV') === 'local' ? $e->getMessage() : 'Erro inesperado. Tente novamente mais tarde.'
            ], 500);
        }
    }

    // Deslogar o usuário e revogar o token
    public function logout(Request $request)
    {
        try {
            // Revoga o token atual
            $request->user()->currentAccessToken()->delete();

            return response()->json(['message' => 'Usuário deslogado com sucesso']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Ocorreu um erro ao deslogar.',
                'message' => env('APP_ENV') === 'local' ? $e->getMessage() : 'Erro inesperado. Tente novamente mais tarde.'
            ], 500);
        }
    }

    public function authUser()
    {
        try {
            return response()->json(Auth::user());
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Ocorreu um erro ao obter os dados do usuário.',
                'message' => env('APP_ENV') === 'local' ? $e->getMessage() : 'Erro inesperado. Tente novamente mais tarde.'
            ], 500);
        }
    }
}
