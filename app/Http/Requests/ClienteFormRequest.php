<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ClienteFormRequest extends FormRequest
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
            'nome' => 'required|max:120|min:5',
            'celular' => 'required|max:11|min:10',
            'email' => 'required|max:120|unique:clientes,email',
            'cpf' => 'required|max:11|min:11|unique:clientes,cpf',
            'dataNascimento' => 'required|date',
            'cidade' => 'required|max:120',
            'estado' => 'required|max:2|min:2',
            'pais' => 'required|max:80',
            'rua' => 'required|max:120',
            'numero' => 'required|max:10',
            'bairro' => 'required|max:100',
            'cep' => 'required|max:8|min:8',
            'complemento' => 'max:150',
            'senha' => 'required'

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
            'nome.required' => 'O campo Nome é obrigatório',
            'nome.max' => 'O campo Nome deve conter no máximo 120 caracteres',
            'nome.min' => 'O campo Nome deve conter no mínimo 5 caracteres',
            'celular.required' => 'O campo Celular é obrigatório',
            'celular.max' => 'O campo Celular deve conter no máximo 11 caracteres',
            'celular.min' => 'O campo Celular deve conter no mínimo 10 caracteres',
            'email.required' => 'O campo Email é obrigatório',
            'email.max' => 'O campo Email deve conter no máximo 120 caracteres',
            'email.unique' => 'Email já cadastrado no sistema',
            'cpf.required' => 'O campo CPF é obrigatório',
            'cpf.max' => 'O campo CPF deve conter no máximo 11 caracteres',
            'cpf.min' => 'O campo CPF deve conter no mínimo 11 caracteres',
            'cpf.unique' => 'CPF já cadastrado no sistema',
            'dataNascimento.required' => 'O campo DataNascimento é obrigatório',
            'dataNascimento.date' => 'O campo DataNascimento deve conter só datas',
            'cidade.required' => 'O campo Cidade é obrigatório',
            'cidade.max' => 'O campo Cidade deve conter no máximo 120 caracteres',
            'estado.required' => 'O campo Estado é obrigatório',
            'estado.max' => 'O campo Estado deve conter no máximo 2 caracteres',
            'estado.min' => 'O campo Estado deve conter no mínimo 2 caracteres',
            'pais.required' => 'O campo País é orbigatório',
            'pais.max' => 'O campo País deve conter no máximo 80 caracteres',
            'rua.required' => 'O campo Rua é obrigatório',
            'rua.max' => 'O campo Rua deve conter no máximo 120 caracteres',
            'numero.required' => 'O campo Número é obrigatório',
            'numero.max' => 'O campo Número deve conter no máximo 10 caracteres',
            'bairro.required' => 'O campo Bairro é obrigatório',
            'bairro.max' => 'O campo Bairro deve conter no máximo 100 caracteres',
            'cep.required' => 'O campo CEP é obrigatório',
            'cep.max' => 'O campo CEP deve conter no máximo 8 caracteres',
            'cep.min' => 'O campo CEP deve conter no mínimo 8 caracteres',
            'complemento.max' => 'O campo Complemento deve conter no máximo 150 caracteres',
            'senha.required' => 'O campo Senha é obrigatório'

        ];
    }
}
