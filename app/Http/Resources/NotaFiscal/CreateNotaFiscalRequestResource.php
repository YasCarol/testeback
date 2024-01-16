<?php

namespace App\Http\Resources\NotaFiscal;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CreateNotaFiscalRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status' => true,
            'message' => 'Nota Fiscal criada com sucesso!',
            'data' => [
                'id' => $this->resource['criador'],
                "Data criação" => Carbon::make($this->resource['created_at'])->format("d-m-Y H:i:s")
            ],
        ];
    }
}
