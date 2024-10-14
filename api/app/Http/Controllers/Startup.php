<?php

namespace App\Http\Controllers;

use App\Models\Startup as ModelsStartup;
use Illuminate\Http\Request;

class Startup extends Controller
{

    public function index()
    {
        try {
            $allUsers = ModelsStartup::all();
            if ($allUsers->isEmpty()) {
                return response()->json('Parece que não existe nenhuma Startup na base de dados', 404);
            }

            return response()->json($allUsers, 200);
        }catch (\Exception $e) {
            // Captura qualquer exceção e retorna a mensagem de erro
            return response()->json([
                'error' => 'Ocorreu um erro ao buscar todas as statups.',
                'message' => env('APP_ENV') === 'local' ? $e->getMessage() : 'Erro inesperado. Tente novamente mais tarde.'
            ], 500);
        }
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
