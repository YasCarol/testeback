<?php

namespace App\DTOs\NotaFiscal;

use App\Http\Requests\NotaFiscal\ShowNotaFiscalRequest;
use App\Http\Requests\NotaFiscal\UpdateNotaFiscalRequest;

class ShowNotaFiscalDTO
{
    public function __construct(
        public $numero,
        public $valor,
        public $data_emissao,
        public $cnpj_remetente,
        public $nome_remetente,
        public $cnpj_transportador,
        public $nome_transportador,
        public $usuario
    ) {
    }
    public static function makeFromRequest(ShowNotaFiscalRequest $request): self
    {
        return new self(
            $request->numero,
            $request->valor,
            $request->data_emissao,
            $request->cnpj_remetente,
            $request->nome_remetente,
            $request->cnpj_transportador,
            $request->nome_transportador,
            $request->header('php-auth-user')
        );
    }
}
