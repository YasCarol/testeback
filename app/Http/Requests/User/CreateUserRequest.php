<?php

namespace App\Http\Requests\User;

use App\Http\Resources\User\FailedCreateUserRequestResource;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required|string|max:100', // // valida se é uma string e se possui no maximo 100 caracteres
            'email' => 'required|string|email|unique:users', // valida se é uma string, se é um email valido e unico na tabela users
            'password' => 'required|min:5|regex:/^(?=.*[A-Z])(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]+$/', // valida se tem no minimo 5 caracteres e se possui pelo menos um especial e um maiusculo
            'cpf' => 'nullable|numeric' // valida se é numerico, se possui no maximo 100 caracteres e se é unico na tabela users
        ];
    }

    public function messages()
    {
        return [
            'password.regex' => 'A senha deve conter pelo menos um caractere maiúsculo e um caractere especial.',
            'email.email' => 'Endereço de email invalido',
            'email.unique' => 'O endereço de email informado ja está cadastrado, por gentileza informe outro',
            'cpf.numeric' => 'O cpf deve conter apenas números.',
            'cpf.cpf_valido' => 'O cpf está invalido',
            'cpf.unique' => 'O cpf informado ja está cadastrado, por gentileza informe outro',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // Retornar uma resposta JSON de erro
        throw new HttpResponseException(response()->json(new FailedCreateUserRequestResource($validator->errors()), 422));
    }
    protected function passedValidation()
    {
        // Realize transformações nos dados após a validação ter ocorrido a validacao
        $this->merge([
            'password' => bcrypt($this->password),
            'name' => ucwords($this->name),
            'cpf' => !empty($this->cpf) ? $this->cpf :  ""
        ]);
    }
}
