<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Proposals as ModelProposals;
use App\Http\Requests\ProposalsRequest; 

class Proposals extends Controller
{
    public function index()
    {
        try {
            $allProposals = ModelProposals::all();
            if ($allProposals->isEmpty()) {
                return response()->json('Parece que não existe nenhuma proposals na base de dados', 404);
            }

            return response()->json($allProposals, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Ocorreu um erro ao buscar todas as proposalss.',
                'message' => env('APP_ENV') === 'local' ? $e->getMessage() : 'Erro inesperado. Tente novamente mais tarde.'
            ], 500);
        }
    }

    public function store(ProposalsRequest $request)
    {
        try {
            // Validação já feita no ProposalsRequest
            $validatedData = $request->validated();

            // Criação da proposals
            $proposals = ModelProposals::create([
                'investimentos' => $validatedData['investimentos'],
                'user_id' => $validatedData['user_id'],
                'startup_id' => $validatedData['startup_id'],
            ]);

            return response()->json(['message' => 'Proposta criada com sucesso!', 'proposals' => $proposals], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Ocorreu um erro ao criar a proposals.',
                'message' => env('APP_ENV') === 'local' ? $e->getMessage() : 'Erro inesperado. Tente novamente mais tarde.'
            ], 500);
        }
    }

    public function show(string $id)
    {
        try {
            $proposals = ModelProposals::find($id);
            if (is_null($proposals)) {
                return response()->json(['message' => 'Parece que essa proposals não existe na base de dados'], 404);
            }

            return response()->json($proposals, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Ocorreu um erro ao buscar uma proposals.',
                'message' => env('APP_ENV') === 'local' ? $e->getMessage() : 'Erro inesperado. Tente novamente mais tarde.'
            ], 500);
        }
    }

    public function update(ProposalsRequest $request, string $id)
    {
        try {
            $proposals = ModelProposals::find($id);

            if (is_null($proposals)) {
                return response()->json(['message' => 'Parece que essa proposals não existe na base de dados'], 404);
            }

            // Validação já feita no ProposalsRequest
            $validatedData = $request->validated();

            // Atualização dos dados da proposals
            $proposals->investimentos = $validatedData['investimentos'];
            $proposals->save();

            return response()->json(['message' => 'Proposta atualizada com sucesso!', 'proposals' => $proposals], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Ocorreu um erro ao atualizar a proposals.',
                'message' => env('APP_ENV') === 'local' ? $e->getMessage() : 'Erro inesperado. Tente novamente mais tarde.'
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $proposals = ModelProposals::find($id);

            if (is_null($proposals)) {
                return response()->json(['message' => 'Parece que essa proposals não existe na base de dados'], 404);
            }

            $proposals->delete();

            return response()->json(['message' => 'Proposta deletada com sucesso.', 'proposals' => $proposals], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Ocorreu um erro ao deletar a proposals.',
                'message' => env('APP_ENV') === 'local' ? $e->getMessage() : 'Erro inesperado. Tente novamente mais tarde.'
            ], 500);
        }
    }
}
