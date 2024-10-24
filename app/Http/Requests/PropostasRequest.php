<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropostasRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        if($this->isMethod('post')){
            return [
                'investimentos' => ['required', 'integer', 'min:0'],
                'user_id' => ['required', 'exists:users,id'],
                'startup_id' => ['required', 'exists:startups,id'],
            ];   
        } else if($this->isMethod('put')){
            return [
                'investimentos' => ['required', 'integer', 'min:0'],
            ];   
        }
    }

    public function messages()
    {    
  
        return [
            'investimentos.required' => 'O campo de investimentos é obrigatório.',
            'investimentos.integer' => 'O valor de investimentos deve ser um número inteiro.',
            'investimentos.min' => 'O valor de investimentos não pode ser negativo.',
            'user_id.required' => 'O campo de usuário é obrigatório.',
            'user_id.exists' => 'O usuário selecionado não existe.',
            'startup_id.required' => 'O campo de startup é obrigatório.',
            'startup_id.exists' => 'A startup selecionada não existe.',
        ];
    }
}
