<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Propostas as ModelPropostas;
use App\Http\Requests\PropostasRequest; 

class Propostas extends Controller
{
    public function index()
    {
        try {
            $allPropostas = ModelPropostas::all();
            if ($allPropostas->isEmpty()) {
                return response()->json('Parece que não existe nenhuma proposta na base de dados', 404);
            }

            return response()->json($allPropostas, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Ocorreu um erro ao buscar todas as propostas.',
                'message' => env('APP_ENV') === 'local' ? $e->getMessage() : 'Erro inesperado. Tente novamente mais tarde.'
            ], 500);
        }
    }

    public function store(PropostasRequest $request)
    {
        try {
            // Validação já feita no PropostasRequest
            $validatedData = $request->validated();

            // Criação da proposta
            $proposta = ModelPropostas::create([
                'investimentos' => $validatedData['investimentos'],
                'user_id' => $validatedData['user_id'],
                'startup_id' => $validatedData['startup_id'],
            ]);

            return response()->json(['message' => 'Proposta criada com sucesso!', 'proposta' => $proposta], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Ocorreu um erro ao criar a proposta.',
                'message' => env('APP_ENV') === 'local' ? $e->getMessage() : 'Erro inesperado. Tente novamente mais tarde.'
            ], 500);
        }
    }

    public function show(string $id)
    {
        try {
            $proposta = ModelPropostas::find($id);
            if (is_null($proposta)) {
                return response()->json(['message' => 'Parece que essa proposta não existe na base de dados'], 404);
            }

            return response()->json($proposta, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Ocorreu um erro ao buscar uma proposta.',
                'message' => env('APP_ENV') === 'local' ? $e->getMessage() : 'Erro inesperado. Tente novamente mais tarde.'
            ], 500);
        }
    }

    public function update(PropostasRequest $request, string $id)
    {
        try {
            $proposta = ModelPropostas::find($id);

            if (is_null($proposta)) {
                return response()->json(['message' => 'Parece que essa proposta não existe na base de dados'], 404);
            }

            // Validação já feita no PropostasRequest
            $validatedData = $request->validated();

            // Atualização dos dados da proposta
            $proposta->investimentos = $validatedData['investimentos'];
            $proposta->save();

            return response()->json(['message' => 'Proposta atualizada com sucesso!', 'proposta' => $proposta], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Ocorreu um erro ao atualizar a proposta.',
                'message' => env('APP_ENV') === 'local' ? $e->getMessage() : 'Erro inesperado. Tente novamente mais tarde.'
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $proposta = ModelPropostas::find($id);

            if (is_null($proposta)) {
                return response()->json(['message' => 'Parece que essa proposta não existe na base de dados'], 404);
            }

            $proposta->delete();

            return response()->json(['message' => 'Proposta deletada com sucesso.', 'proposta' => $proposta], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Ocorreu um erro ao deletar a proposta.',
                'message' => env('APP_ENV') === 'local' ? $e->getMessage() : 'Erro inesperado. Tente novamente mais tarde.'
            ], 500);
        }
    }
}
