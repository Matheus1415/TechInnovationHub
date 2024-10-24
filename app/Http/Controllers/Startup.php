<?php

namespace App\Http\Controllers;

use App\Http\Requests\StartupRequest;
use App\Models\Startup as ModelsStartup;
use App\Models\User;
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

    public function store(StartupRequest $request)
    {
        try {
            // Validação já feita no UserRequest
            $validatedData = $request->validated();
            $user = User::find($validatedData['user_id']);
            // Corrigindo a verificação de existência do usuário
            if(!$user){
                return response()->json([
                    'error' => 'Usuário não existe.',
                    'message' => 'Parece que esse usuário não existe na base de dados.'
                ], 404);
            }

            // Criando a startup
            $startup = ModelsStartup::create([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'tempo_disponivel' => $validatedData['tempo_disponivel'],
                'tecnologias' => json_encode($validatedData['tecnologias']), // Convertendo array para JSON
                'contato_informacao' => $validatedData['contato_informacao'],
                'licenca' => $validatedData['licenca'],
                'tags' => json_encode($validatedData['tags']), // Convertendo array para JSON
                'user_id' => $validatedData['user_id'],
            ]);

            return response()->json(['message' => 'Startup criada com sucesso!', 'startup' => $startup], 201);

        } catch (\Exception $e) {
            // Captura qualquer exceção e retorna a mensagem de erro
            return response()->json([
                'error' => 'Ocorreu um erro ao criar a startup.',
                'message' => env('APP_ENV') === 'local' ? $e->getMessage() : 'Erro inesperado. Tente novamente mais tarde.'
            ], 500);
        }
    }


    public function show(string $id)
    {
        try {
            $startup = ModelsStartup::find($id);
            if (is_null($startup)) {
                return response()->json(['message' => 'Parece que essa startup não existe na base de dados'], 404);
            }

            return response()->json($startup, 200);
        } catch (\Exception $e) {
            // Captura qualquer exceção e retorna a mensagem de erro
            return response()->json([
                'error' => 'Ocorreu um erro ao buscar uma startup.',
                'message' => env('APP_ENV') === 'local'? $e->getMessage() : 'Erro inesperado. Tente novamente mais tarde.'
            ], 500);
        }
    }

    public function edit(string $id)
    {
        //
    }

    public function update(StartupRequest $request, string $id)
    {
        try {
            // Encontra a startup pelo ID
            $startup = ModelsStartup::find($id);

            // Verifica se a startup existe
            if (is_null($startup)) {
                return response()->json(['message' => 'Parece que essa startup não existe na base de dados'], 404);
            }

            // Validação já feita no StartupRequest
            $validatedData = $request->validated();

            // Atualiza os dados da startup
            $startup->title = $validatedData['title'];
            $startup->description = $validatedData['description'];
            $startup->tempo_disponivel = $validatedData['tempo_disponivel'];
            $startup->tecnologias = $validatedData['tecnologias'];
            $startup->contato_informacao = $validatedData['contato_informacao'];
            $startup->licenca = $validatedData['licenca'];
            $startup->tags = $validatedData['tags'];
            $startup->save();

            // Retorna uma resposta de sucesso
            return response()->json(['message' => 'Startup atualizada com sucesso!', 'startup' => $startup], 200);
        } catch (\Exception $e) {
            // Captura qualquer exceção e retorna a mensagem de erro
            return response()->json([
                'error' => 'Ocorreu um erro ao atualizar a startup.',
                'message' => env('APP_ENV') === 'local' ? $e->getMessage() : 'Erro inesperado. Tente novamente mais tarde.'
            ], 500);
        }
    }


    public function destroy(string $id)
    {
        try {
            $startup = ModelsStartup::find($id);//Emcontra a Startuo pelo ID
            if (is_null($startup)) { // Verifica se o usuário não foi encontrado
                return response()->json(['message' => 'Parece que essa startup não existe na base de dados'], 404);
            }

            $startup->delete(); // Deleta o startup
            
            return response()->json([
                'message' => 'Startup deletado com sucesso.',
                'startup' => $startup,
            ], 200); 

        } catch (\Exception $e) {
            // Captura qualquer exceção e retorna a mensagem de erro
            return response()->json([
                'error' => 'Ocorreu um erro ao atualizar a startup.',
                'message' => env('APP_ENV') === 'local' ? $e->getMessage() : 'Erro inesperado. Tente novamente mais tarde.'
            ], 500);
        }
    }
}
