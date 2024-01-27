<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'max:80|min:5',
            'preco' => 'decimal:2',
            'descricao' => 'max:200|min:10',
            'duracao' => 'numeric'
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'success' => false,
            'error' => $validator->errors()

        ]));
    }

    public function messages(){
        return [
            'nome.max' => 'O campo Nome deve conter no máximo 80 caracteres',
            'nome.min' => 'O campo Nome deve conter no mínimo 5 caracteres',
            'preco.decimal' => 'O campo Preço deve conter apenas valores em decimais',
            'descricao.max' => 'O campo Descrição deve conter no máximo 200 caracteres',
            'descricao.min' => 'O campo Descrição deve conter no mínimo 10 caracteres',
            'duracao.numeric' => 'O campo Duração do Serviço deve conter apenas números'
        ];
    }
}
