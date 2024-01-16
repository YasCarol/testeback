<?php

namespace App\Http\Resources\NotaFiscal;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FailedShowNotaFiscalRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status' => false,
            'message' => 'Informacoes importantes faltando',
            'erros' => [
                "mensagem" =>  $this->resource,
            ],
        ];
    }
}
