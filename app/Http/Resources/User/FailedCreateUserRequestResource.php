<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FailedCreateUserRequestResource extends JsonResource
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
