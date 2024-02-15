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
            'name' => 'required|max:120|min:5',
            'cellphone' => 'required|max:11|min:10|unique:administradors,cellphone',
            'email' => 'required|max:120|unique:administradors,email',
            'cpf' => 'required|max:11|min:11|unique:administradors,cpf',
            'password' => 'required'
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
            'name.required' => 'O campo Nome é obrigatório',
            'name.max' => 'O campo Nome deve conter no máximo 120 caracteres',
            'name.min' => 'O campo Nome deve conter no mínimo 5 caracteres',
            'cellphone.required' => 'O campo Celular é obrigatório',
            'cellphone.max' => 'O campo Celular deve conter no máximo 11 caracteres',
            'cellphone.min' => 'O campo Celular deve conter no mínimo 10 caracteres',
            'cellphone.unique' => 'Celular já cadastrado no sistema',
            'email.required' => 'O campo E-mail é obrigatório',
            'email.max' => 'O campo E-mail deve conter no máximo 120 caracteres',
            'email.unique' => 'E-mail já cadastrado no sistema',
            'cpf.required' =>  'O campo CPF é obrigatório',
            'cpf.max' => 'O campo CPF deve conter no máximo 11 caracteres',
            'cpf.min' => 'O campo CPF deve conter no mínimo 11 caracteres',
            'cpf.unique' => 'CPF já cadastrado no sistema',
            'password.required' => 'O campo Senha é obrigatório'
        ];
    }
}
