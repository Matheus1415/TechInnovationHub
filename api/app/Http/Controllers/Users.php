<?php

namespace App\Http\Controllers;

//Request Personalizados
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
//Models
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Users extends Controller
{

    public function index()
    {
        try {
            $allUsers = User::all();
            if ($allUsers->isEmpty()) {
                return response()->json('Parece que não existe nenhum usuário na base de dados', 404);
            }

            return response()->json($allUsers, 200);
        }catch (\Exception $e) {
            // Captura qualquer exceção e retorna a mensagem de erro
            return response()->json([
                'error' => 'Ocorreu um erro ao buscar todos os usuário.',
                'message' => env('APP_ENV') === 'local' ? $e->getMessage() : 'Erro inesperado. Tente novamente mais tarde.'
            ], 500);
        }
    }

    public function create()
    {
        //
    }

    public function store(UserRequest $request)
    {
        try {
            // Validação já feita no UserRequest
            $validatedData = $request->validated();
    
            // Criação do usuário
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['senha']),
                'typeUser' => $validatedData['typeUser'],
                'cidade' => $validatedData['cidade'],
                'UF' => $validatedData['UF'],
                'telefone' => $validatedData['telefone'],
            ]);
    
            return response()->json(['message' => 'Usuário criado com sucesso!', 'user' => $user], 201);
    
        } catch (\Exception $e) {
            // Captura qualquer exceção e retorna a mensagem de erro
            return response()->json([
                'error' => 'Ocorreu um erro ao criar o usuário.',
                'message' => env('APP_ENV') === 'local' ? $e->getMessage() : 'Erro inesperado. Tente novamente mais tarde.'
            ], 500);
        }
    }       

    public function show(string $id)
    {
        try {
            $user = User::find($id); // Encontra o usuário pelo ID
            if (is_null($user)) { // Verifica se o usuário não foi encontrado
                return response()->json(['message' => 'Parece que esse usuário não existe na base de dados'], 404);
            }
            return response()->json($user, 200); 
        } catch (\Exception $e) {
            // Captura qualquer exceção e retorna a mensagem de erro
            return response()->json([
                'error' => 'Ocorreu um erro ao buscar um usuário.',
                'message' => env('APP_ENV') === 'local' ? $e->getMessage() : 'Erro inesperado. Tente novamente mais tarde.'
            ], 500);
        }
    }    

    public function edit(string $id)
    {
        //
    }

    public function update(UserRequest $request, string $id)
    {
        try {
            $user = User::find($id); // Encontra o usuário pelo ID
            if (is_null($user)) { // Verifica se o usuário não foi encontrado
                return response()->json(['message' => 'Parece que esse usuário não existe na base de dados'], 404);
            }
    
            // Validação já feita no UserRequest
            $validatedData = $request->validated();
    
            // Atualiza os dados do usuário
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->password = Hash::make($validatedData['senha']); 
            $user->typeUser = $validatedData['typeUser'];
            $user->cidade = $validatedData['cidade'];
            $user->UF = $validatedData['UF'];
            $user->telefone = $validatedData['telefone'];
            
            $user->save(); // Salva as alterações no banco de dados
    
            return response()->json(['message' => 'Usuário atualizado com sucesso!', 'user' => $user], 200);
    
        } catch (\Exception $e) {
            // Captura qualquer exceção e retorna a mensagem de erro
            return response()->json([
                'error' => 'Ocorreu um erro ao atualizar o usuário.',
                'message' => env('APP_ENV') === 'local' ? $e->getMessage() : 'Erro inesperado. Tente novamente mais tarde.'
            ], 500);
        }
    }
    
    public function destroy(string $id)
    {
        try {
            $user = User::find($id); // Encontra o usuário pelo ID
            if (is_null($user)) { // Verifica se o usuário não foi encontrado
                return response()->json(['message' => 'Parece que esse usuário não existe na base de dados'], 404);
            }
    
            $user->delete(); // Deleta o usuário
            
            return response()->json([
                'message' => 'Usuário deletado com sucesso.',
                'user' => $user,
            ], 200); 
    
        } catch (\Exception $e) {
            // Captura qualquer exceção e retorna a mensagem de erro
            return response()->json([
                'error' => 'Ocorreu um erro ao deletar o usuário.',
                'message' => env('APP_ENV') === 'local' ? $e->getMessage() : 'Erro inesperado. Tente novamente mais tarde.'
            ], 500);
        }
    }
    
}
