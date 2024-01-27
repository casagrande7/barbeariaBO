<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AgendaFormRequest extends FormRequest
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
            'profissional_id' => 'required|integer',
            'data_hora' =>  'required|date',
        ];
    }
    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'status' => false,
            'error' => $validator->errors()

        ]));
    }
    public function messages(){
        return[
            'data_hora.required' => 'O campo Data e Hora é obrigatório',
            'data_hora.date' => 'O campo Data e Hora deve conter apenas datas e horários',
            'profissional_id.integer' => 'O ID tem que ser um número inteiro',
            'profissional_id.required' => 'O campo Profissional é obrigatório',
            
        ];
    }
}
