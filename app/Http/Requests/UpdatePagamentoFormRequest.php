<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdatePagamentoFormRequest extends FormRequest
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
            'nome' => '',
            'taxa' => 'max:4|min:2',
            'status' => 'max:15|min:5'
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
            'taxa.max' => 'O campo taxa deve conter no máximo 4 caracteres',
            'taxa.min' => 'O campo taxa deve conter no mínimo 2 caracteres',
            'status.max' => 'O campo Status deve conter no máximo 7 caracteres',
            'status.min' => 'O campo Status deve conter no mínimo 5 caracteres'
        ];
    }
}
