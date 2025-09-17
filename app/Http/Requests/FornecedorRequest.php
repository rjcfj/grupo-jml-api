<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CnpjValido;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class FornecedorRequest extends FormRequest
{
    public function rules()
    {
        $fornecedorId = $this->route('fornecedore') ? $this->route('fornecedore') : null;

        return [
            'nome' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'cnpj' => [
                'required',
                'string',
                'min:14',
                'max:18',
                $fornecedorId
                    ? 'unique:fornecedores,cnpj,' . $fornecedorId
                    : 'unique:fornecedores,cnpj',
                new CnpjValido,
            ],
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo Nome é obrigatório.',
            'nome.max' => 'O campo Nome não deve ter mais de 255 caracteres.',
            'cnpj.required' => 'O campo CNPJ é obrigatório.',
            'cnpj.min' => 'O campo CNPJ deve ter pelo menos 14 caracteres.',
            'cnpj.max' => 'O campo CNPJ não deve ter mais de 18 caracteres.',
            'cnpj.unique' => 'O cnpj já foi criado.',
            'email.required' => 'O campo Email é obrigatório. ',
            'email.email' => 'O campo Email deve ser um endereço válido.',
            'email.string' => 'O campo de e-mail deve ser uma sequência de caracteres.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Erro de validação',
            'errors'  => $validator->errors()
        ], 422));
    }
}
