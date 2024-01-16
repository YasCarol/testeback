<?php

namespace App\Repositories\NotaFiscal;

use App\DTOs\NotaFiscal\CreateNotaFiscalDTO;
use App\DTOs\NotaFiscal\DeleteNotaFiscalDTO;
use App\DTOs\NotaFiscal\ShowNotaFiscalDTO;
use App\DTOs\NotaFiscal\UpdateNotaFiscalDTO;
use App\Models\NotaFiscal;

class NotaFiscalRepository
{
    private $notaFiscalModel;

    public function __construct()
    {
        $this->notaFiscalModel = new NotaFiscal();
    }
    public function create(CreateNotaFiscalDTO $dto)
    {
        $user = $this->notaFiscalModel->create([
            'numero' => $dto->numero,
            'valor' => $dto->valor,
            'dt_emis' => $dto->data_emissao,
            'cnpj_remetente' => $dto->cnpj_remetente,
            'nome_remetente' => $dto->nome_remetente,
            'cnpj_transportador' => $dto->cnpj_transportador,
            'nome_transportador' => $dto->nome_transportador,
            'criador' => $dto->usuario
        ]);
        return $user;
    }
    public function update(UpdateNotaFiscalDTO $dto, $atualizar)
    {
        $this->notaFiscalModel->where('numero', $dto->numero)->where('criador', $dto->usuario)->update($atualizar);
        return ['numero' => $dto->numero, 'criador' => $dto->usuario];
    }
    public function show(ShowNotaFiscalDTO $dto)
    {
        if (empty($dto->numero)) {
            $notaFiscal = $this->notaFiscalModel->where('criador', $dto->usuario)->get();
        } else {
            $notaFiscal = $this->notaFiscalModel->where('numero', $dto->numero)->where('criador', $dto->usuario)->get();
        }
        return $notaFiscal;
    }
    public function delete(DeleteNotaFiscalDTO $dto)
    {
        $notaFiscal = $this->notaFiscalModel->where('numero', $dto->numero)->where('criador', $dto->usuario)->get();
        $this->notaFiscalModel->where('numero', $dto->numero)->where('criador', $dto->usuario)->delete();
        return $notaFiscal;
    }
}
