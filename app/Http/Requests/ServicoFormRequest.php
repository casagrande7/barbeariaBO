<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ServicoFormRequest extends FormRequest
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
            'nome' => 'required|max:80|min:5|unique:servicos,Nome',
            'preco' => 'required|decimal:2',
            'descricao' => 'required|max:200|min:10',
            'duracao' => 'required|numeric'
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
            'nome.required' => 'Nome é obrigatório',
            'nome.max' => 'O campo Nome deve conter no máximo 80 caracteres',
            'nome.min' => 'O campo Nome deve conter no mínimo 5 caracteres',
            'preco.required' => 'Preço é obrigatório',
            'preco.decimal' => 'O campo Preço deve conter apenas valores em decimais',
            'descricao.required' => 'Descrição é obrigatório',
            'descricao.max' => 'O campo Descrição deve conter no máximo 200 caracteres',
            'descricao.min' => 'O campo Descrição deve conter no mínimo 10 caracteres',
            'duracao.required' => 'Duração do Serviço é obrigatório',
            'duracao.numeric' => 'O campo Duração do Serviço deve conter apenas números'
        ];
    }
   
}
