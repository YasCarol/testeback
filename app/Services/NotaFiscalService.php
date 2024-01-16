<?php

namespace App\Services;

use App\DTOs\NotaFiscal\CreateNotaFiscalDTO;
use App\DTOs\NotaFiscal\DeleteNotaFiscalDTO;
use App\DTOs\NotaFiscal\UpdateNotaFiscalDTO;
use App\DTOs\NotaFiscal\ShowNotaFiscalDTO;
use App\Http\Requests\NotaFiscal\UpdateNotaFiscalRequest;
use App\Notifications\CreateNotaFiscalNotification;
use App\Repositories\NotaFiscal\NotaFiscalRepository;

class NotaFiscalService
{

    private $notaFiscalRepository;

    public function __construct()
    {
        $this->notaFiscalRepository = new NotaFiscalRepository;
    }

    public function newNotaFiscal(CreateNotaFiscalDTO $dto)
    {
        $notaFiscal = $this->notaFiscalRepository->create($dto);
        $notaFiscal->notify(new CreateNotaFiscalNotification($notaFiscal));
        return $notaFiscal;
    }
    public function updateNotaFiscal(UpdateNotaFiscalDTO $dto)
    {
        isset($dto->valor) ? $atualizar['valor'] = $dto->valor : null;
        isset($dto->data_emissao) ? $atualizar['dt_emis'] = $dto->data_emissao : null;
        isset($dto->cnpj_remetente) ? $atualizar['cnpj_remetente'] = $dto->cnpj_remetente : null;
        isset($dto->nome_remetente) ? $atualizar['nome_remetente'] = $dto->nome_remetente : null;
        isset($dto->cnpj_transportador) ? $atualizar['cnpj_transportador'] = $dto->cnpj_transportador : null;
        isset($dto->nome_transportador) ? $atualizar['nome_transportador'] = $dto->nome_transportador : null;
        return $this->notaFiscalRepository->update($dto, $atualizar);
    }
    public function showNotaFiscal(ShowNotaFiscalDTO $dto)
    {
        return $this->notaFiscalRepository->show($dto);
    }
    public function deleteNotaFiscal(DeleteNotaFiscalDTO $dto)
    {
        return $this->notaFiscalRepository->delete($dto);
    }
}
