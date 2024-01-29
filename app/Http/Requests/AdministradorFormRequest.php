<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AdministradorFormRequest extends FormRequest
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
            'nome' => 'required|max:120|min:5',
            'celular' => 'required|max:11|min:10|unique:administradors,celular',
            'email' => 'required|max:120|unique:administradors,email',
            'cpf' => 'required|max:11|min:11|unique:administradors,cpf',
            'senha' => 'required'
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
            'nome.required' => 'O campo Nome é obrigatório',
            'nome.max' => 'O campo Nome deve conter no máximo 120 caracteres',
            'nome.min' => 'O campo Nome deve conter no mínimo 5 caracteres',
            'celular.required' => 'O campo Celular é obrigatório',
            'celular.max' => 'O campo Celular deve conter no máximo 11 caracteres',
            'celular.min' => 'O campo Celular deve conter no mínimo 10 caracteres',
            'celular.unique' => 'Celular já cadastrado no sistema',
            'email.required' => 'O campo E-mail é obrigatório',
            'email.max' => 'O campo E-mail deve conter no máximo 120 caracteres',
            'email.unique' => 'E-mail já cadastrado no sistema',
            'cpf.required' =>  'O campo CPF é obrigatório',
            'cpf.max' => 'O campo CPF deve conter no máximo 11 caracteres',
            'cpf.min' => 'O campo CPF deve conter no mínimo 11 caracteres',
            'cpf.unique' => 'CPF já cadastrado no sistema',
            'senha.required' => 'O campo Senha é obrigatório'
        ];
    }
}
