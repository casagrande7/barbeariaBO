<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateClienteFormRequest extends FormRequest
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
            'nome' => 'max:120|min:5',
            'celular' => 'max:11|min:10',
            'email' => 'max:120|email:rfc,|unique:clientes,email,' .$this-> id,
            'cpf' => 'max:11|min:11|unique:clientes,cpf,' . $this -> id,
            'dataNascimento' => '',
            'cidade' => 'max:120', 
            'estado' => 'max:2|min:2' ,
            'pais' => 'max:80',
            'rua' => 'max:120',
            'numero' => 'max:10',
            'bairro' => 'max:100',
            'cep' => 'max:8|min:8',
            'complemento' => 'max:150',
            'senha' => ''
        
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'success' => false,
            'error' => $validator->errors()

        ]));
    }

    public function messages(){
        return[

    'nome.max' => 'O campo Nome deve conter no máximo 120 caracteres',
    'nome.min' => 'O campo Nome deve conter no mínimo 5 caracteres',
    'celular.max' => 'O campo Celular deve conter no máximo 11 caracteres',
    'celular.min' => 'O campo Celular deve conter no mínimo 10 caracteres',
    'email.max' => 'O campo Email deve conter no máximo 120 caracteres',
    'cpf.max' => 'O campo CPF deve conter no máximo 11 caracteres',
    'cpf.min' => 'O campo CPF deve conter no mínimo 11 caracteres',
    'dataNascimento.date' => 'O campo DataNascimento deve conter só datas',
    'cidade.max' => 'O campo Cidade deve conter no máximo 120 caracteres',
    'estado.max' => 'O campo Estado deve conter no máximo 2 caracteres',
    'estado.min' => 'O campo Estado deve conter no mínimo 2 caracteres',
    'pais.max' => 'O campo País deve conter no máximo 80 caracteres',
    'rua.max' => 'O campo Rua deve conter no máximo 120 caracteres',
    'numero.max' => 'O campo Número deve conter no máximo 10 caracteres',
    'bairro.max' => 'O campo Bairro deve conter no máximo 100 caracteres',
    'cep.max' => 'O campo CEP deve conter no máximo 8 caracteres',
    'cep.min' => 'O campo CEP deve conter no mínimo 8 caracteres',
    'complemento.max' => 'O campo Complemento deve conter no máximo 150 caracteres',
        ];
}
}