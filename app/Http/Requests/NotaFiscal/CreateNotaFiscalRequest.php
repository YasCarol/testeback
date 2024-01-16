<?php

namespace App\Http\Requests\NotaFiscal;

use App\Http\Resources\NotaFiscal\FailedCreateNotaFiscalRequestResource;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CreateNotaFiscalRequest extends FormRequest
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
            'numero' => 'required|string|digits:9', // valida se é string e se possui 9 digitos
            'valor' => 'required|numeric|gt:0', // valida se é numerico e maior que 0
            'data_emissao' => 'required|date|before_or_equal:today', // valida se é uma data valida e anterior ou igual a atual
            'cnpj_remetente' => 'required|string', // valida se é string e se possui 14 digitos
            'nome_remetente' => 'required|string|max:100', // valida se é uma string e se possui no maximo 100 caracteres
            'cnpj_transportador' => 'required|string', // valida se é string e se possui 14 digitos
            'nome_transportador' => 'required|string|max:100', // valida se é uma string e se possui no maximo 100 caracteres
        ];
    }

    public function messages()
    {
        return [
            'numero.required' => 'O campo numero é obrigatório',
            'numero.string' => 'O campo numero deve ser string',
            'numero.digits' => 'O campo numero deve possuir 9 digitos',
            'valor.required' => 'O campo valor é obrigatório',
            'valor.numeric' => 'O campo valor deve ser numerico',
            'valor.gt' => 'O campo valor deve ser maior que 0',
            'data_emissao.required' => 'O campo data_emissao é obrigatório',
            'data_emissao.date' => 'O campo data_emissao deve ser uma data valida ex: Y-m-d H:i:s',
            'data_emissao.before_or_equal' => 'O campo data_emissao deve maior ou igual a data atual, data atual: ' . date("d-m-Y H:i:s"),
            'cnpj_remetente.required' => 'O campo cnpj_remetente é obrigatório',
            'cnpj_remetente.string' => 'O campo cnpj_remetente deve ser string',
            'cnpj_remetente.cnpj_valido' => 'O campo cnpj_remetente está com valor invalido',
            'nome_remetente.required' => 'O campos nome_remetente é obrigatório',
            'nome_remetente.string' => 'O campo nome_remetente deve ser string',
            'nome_remetente.max' => 'O campo nome_remetente deve possuir no maximo 100 caracteres',
            'cnpj_transportador.required' => 'O campo cnpj_transportador é obrigatório',
            'cnpj_transportador.string' => 'O campo cnpj_transportador deve ser string',
            'cnpj_transportador.cnpj_valido' => 'O campo cnpj_transportador está com valor invalido',
            'nome_transportador.required' => 'O campos nome_transportador é obrigatório',
            'nome_transportador.string' => 'O campo nome_transportador deve ser string',
            'nome_transportador.max' => 'O campo nome_transportador deve possuir no maximo 100 caracteres',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // Retornar uma resposta JSON de erro
        throw new HttpResponseException(response()->json(new FailedCreateNotaFiscalRequestResource($validator->errors()), 422));
    }
}
