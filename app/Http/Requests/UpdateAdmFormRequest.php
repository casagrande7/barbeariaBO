<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateAdmFormRequest extends FormRequest
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
            'nome' => 'max:120|min:5',
            'celular' => 'max:11|min:10|unique:administradors,celular,' . $this->id,
            'email' => 'max:120|email:rfc,|unique:administradors,email,' . $this->id,
            'cpf' => 'max:11|min:11|unique:administradors,cpf,' . $this->id,
            'senha' => ''
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'error' => $validator->errors()

        ]));
    }

    public function messages()
    {
        return [
            'nome.max' => 'O campo Nome deve conter no máximo 120 caracteres',
            'nome.min' => 'O campo Nome deve conter no mínimo 5 caracteres',
            'celular.max' => 'O campo Celular deve conter no máximo 11 caracteres',
            'celular.min' => 'O campo Celular deve conter no mínimo 10 caracteres',
            'email.max' => 'O campo Email deve conter no máximo 120 caracteres',
            'email.unique' => 'E-mail já cadastrado no sistema',
            'cpf.max' => 'O campo CPF deve conter no máximo 11 caracteres',
            'cpf.min' => 'O campo CPF deve conter no mínimo 11 caracteres',
        ];
    }
}
