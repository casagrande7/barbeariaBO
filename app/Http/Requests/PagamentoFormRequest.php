<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PagamentoFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|unique:tipo_de_pagamentoS,nome',
            'taxa' => 'max:4|min:2',
            'status' => 'required|max:15|min:5'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'error' => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo Nome é obrigatório conter o tipo de pagamento',
            'nome.unique' => 'Nome já foi cadastrado, informe outro',
            'taxa.max' => 'O campo Taxa deve conter no máximo 4 caracteres',
            'taxa.min' => 'O campo Taxa deve conter no mínimo 2 caracteres',
            'condicao.required' => 'O campo Condição é obrigatório',
            'status.max' => 'O campo Condição deve conter no máximo 15 caracteres',
            'status.min' => 'O campo Condição deve conter no mínimo 5 caracteres'
        ];
    }
}
