<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'erros' => $validator->errors()
        ], 422));//O código de status HTTP 422 significa "Unprocessable Entity" ( Entidade Não Processável). Esse código é usado quando o servidor entende a requisição do cliente
                        //, mas não pode processá-la devido a erros de validação no lado de servidor.
        
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        //Recuperar o id do usuário enviado na URL
         $userId = $this->route('user');
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.($userId ? $userId->id : null),
            'password' => 'required|min:8'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Campo nome é obrigatório!',
            'email.required' => 'Campo e-mail é obrigatório!',
            'email.email' => 'Necessario enviar e-mail válido',
            'email.unique' => 'O e-mail Já esta cadastrado!',
            'password.required' => 'Campo senha é obrigatório!',
            'password.min' => 'Senha com no mínimo :min caracteres!'

        ];

    }




}
