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
            // Validação de campos
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            // Captura das credenciais do usuário
            $credentials = $request->only('email', 'password');
            
            // Tentativa de autenticação do usuário
            if (!Auth::attempt($credentials)) {
                return response()->json([
                    "message" => "Ops, parece que seu e-mail ou senha estão incorretos."
                ], 401);
            }

            // Se a autenticação foi bem-sucedida, cria um token via Sanctum
            $user = Auth::user();
            $token = $user->createToken('access-token')->plainTextToken;

            // Retorna o token gerado e informações sobre ele
            return response()->json([
                'token' => $token,
                'token_type' => 'bearer',
                'expires_in' => null // Sanctum não lida com expiração por padrão
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
