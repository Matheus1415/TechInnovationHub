<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StartupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Permitir a autorização da requisição
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('post')) {
            // Regras para a criação da startup
            return [
                'title' => ['required', 'string', 'max:255'], 
                'description' => ['required', 'string'], 
                'tempo_disponivel' => ['required', 'date'], 
                'tecnologias' => ['required', 'array'], 
                'tecnologias.*' => ['string'], 
                'contato_informacao' => ['required', 'email'], 
                'licenca' => ['required', 'string'], 
                'tags' => ['required', 'array'], 
                'tags.*' => ['string'],
                'user_id' => ['required', 'exists:users,id'],
            ];
        } elseif ($this->isMethod('put')) {
            // Regras para a atualização da startup
            return [
                'title' => ['nullable', 'string', 'max:255'], 
                'description' => ['nullable', 'string'], 
                'tempo_disponivel' => ['nullable', 'date'], 
                'tecnologias' => ['nullable', 'array'], 
                'tecnologias.*' => ['string'], 
                'contato_informacao' => ['nullable', 'email'], 
                'licenca' => ['nullable', 'string'], 
                'tags' => ['nullable', 'array'], 
                'tags.*' => ['string'],
                // O user_id não deve ser incluído aqui
            ];
        }

        return [];
    }   

    public function messages(): array
    {
        return [
            'title.required' => 'O título da startup é obrigatório.',
            'title.string' => 'O título deve ser um texto válido.',
            'title.max' => 'O título não pode ter mais de 255 caracteres.',
            
            'description.required' => 'A descrição da startup é obrigatória.',
            'description.string' => 'A descrição deve ser um texto válido.',
            
            'tempo_disponivel.required' => 'O tempo disponível é obrigatório.',
            'tempo_disponivel.date' => 'O campo tempo disponível deve ser uma data válida.',
            
            'tecnologias.required' => 'As tecnologias utilizadas são obrigatórias.',
            'tecnologias.array' => 'As tecnologias devem estar em formato de lista.',
            'tecnologias.*.string' => 'Cada tecnologia deve ser um texto válido.',
            
            'contato_informacao.required' => 'As informações de contato são obrigatórias.',
            'contato_informacao.email' => 'O contato deve ser um e-mail válido.',
            
            'licenca.required' => 'A licença da startup é obrigatória.',
            'licenca.string' => 'A licença deve ser um texto válido.',
            
            'tags.required' => 'As tags são obrigatórias.',
            'tags.array' => 'As tags devem estar em formato de lista.',
            'tags.*.string' => 'Cada tag deve ser um texto válido.',
        ];
    }
}
