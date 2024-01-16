<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('cnpj_valido', function ($attribute, $value, $parameters, $validator) {
            // Remove caracteres não numéricos
            $cnpj = preg_replace('/[^0-9]/', '', $value);

            // Verifica se o CNPJ possui 14 dígitos
            if (strlen($cnpj) !== 14) {
                return false;
            }

            // Verifica se todos os dígitos são iguais (caso comum de CNPJs inválidos)
            if (preg_match('/(\d)\1{13}/', $cnpj)) {
                return false;
            }

            // Validação do primeiro dígito verificador
            for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
                $soma += $cnpj[$i] * $j;
                $j = ($j === 2) ? 9 : $j - 1;
            }
            $resto = $soma % 11;
            $dv1 = ($resto < 2) ? 0 : 11 - $resto;

            // Validação do segundo dígito verificador
            for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
                $soma += $cnpj[$i] * $j;
                $j = ($j === 2) ? 9 : $j - 1;
            }
            $resto = $soma % 11;
            $dv2 = ($resto < 2) ? 0 : 11 - $resto;

            // Verifica se os dígitos verificadores são válidos
            return ($cnpj[12] == $dv1 && $cnpj[13] == $dv2);
        });
        Validator::extend('cpf_valido', function ($attribute, $value, $parameters, $validator) {
            // Lógica de validação do CPF
            $cpf = preg_replace('/[^0-9]/', '', $value);

            // Verifica se o CPF possui 11 dígitos
            if (strlen($cpf) !== 11) {
                return false;
            }

            // Calcula e verifica os dígitos verificadores
            $soma = 0;
            for ($i = 0; $i < 9; $i++) {
                $soma += $cpf[$i] * (10 - $i);
            }
            $resto = $soma % 11;
            $digito1 = ($resto < 2) ? 0 : 11 - $resto;

            $soma = 0;
            for ($i = 0; $i < 10; $i++) {
                $soma += $cpf[$i] * (11 - $i);
            }
            $resto = $soma % 11;
            $digito2 = ($resto < 2) ? 0 : 11 - $resto;

            return ($cpf[9] == $digito1 && $cpf[10] == $digito2);
        });
    }
}
