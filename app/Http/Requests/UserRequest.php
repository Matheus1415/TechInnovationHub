<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        $userId = $this->route('id');

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $userId,
            'profile' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8',
            'typeUser' => 'integer',
            'cit' => 'required|string|max:255',
            'UF' => 'required|string|max:2',
            'tel' => 'required|string|max:20',
            'typeUser' => 'required|string',
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.max' => 'O campo nome deve ter no máximo 255 caracteres.',
            'profile.string' => 'O campo deve ser do tipo string.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.unique' => 'Ops! Parece que este e-mail já está cadastrado.',
            'senha.required' => 'O campo senha é obrigatório.',
            'senha.min' => 'A senha deve ter no mínimo 8 caracteres.',
            'UF.max' => 'A sigla do estado (UF) deve ter no máximo 2 caracteres.',
            'UF.required' => 'O campo UF é obrigatório.',
            'telefone.required' => 'O campo telefone é obrigatório.',
            'telefone.max' => 'O telefone deve ter no máximo 20 caracteres.',
            'typeUser.required' => 'O campo tipo de usúario é obrigatório.',
            'typeUser.string' => 'O campo usúario deve ser uma string.',
        ];
    }
}
