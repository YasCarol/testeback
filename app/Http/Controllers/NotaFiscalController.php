<?php

namespace App\Http\Controllers;

use App\DTOs\NotaFiscal\CreateNotaFiscalDTO;
use App\DTOs\NotaFiscal\UpdateNotaFiscalDTO;
use App\DTOs\NotaFiscal\ShowNotaFiscalDTO;
use App\DTOs\NotaFiscal\DeleteNotaFiscalDTO;
use App\Http\Requests\NotaFiscal\UpdateNotaFiscalRequest;
use App\Http\Requests\NotaFiscal\CreateNotaFiscalRequest;
use App\Http\Requests\NotaFiscal\DeleteNotaFiscalRequest;
use App\Http\Requests\NotaFiscal\ShowNotaFiscalRequest;
use App\Http\Resources\NotaFiscal\CreateNotaFiscalRequestResource;
use App\Http\Resources\NotaFiscal\DeleteNotaFiscalRequestResource;
use App\Http\Resources\NotaFiscal\UpdateNotaFiscalRequestResource;
use App\Http\Resources\NotaFiscal\ShowNotaFiscalRequestResource;
use App\Services\NotaFiscalService;
use Illuminate\Http\Request;

class NotaFiscalController extends Controller
{
    private $notaFiscalService;

    public function __construct()
    {
        $this->notaFiscalService = new NotaFiscalService();
    }
    public function create(CreateNotaFiscalRequest $request) // CREATE -> Criar Notas Fiscais
    {
        $notaFiscal = $this->notaFiscalService->newNotaFiscal(CreateNotaFiscalDTO::makeFromRequest($request));
        return new CreateNotaFiscalRequestResource($notaFiscal);
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowNotaFiscalRequest $request) // READ -> listar nota fiscal
    {
        $notaFiscal = $this->notaFiscalService->showNotaFiscal(ShowNotaFiscalDTO::makeFromRequest($request));
        return new ShowNotaFiscalRequestResource($notaFiscal);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNotaFiscalRequest $request) // UPDATE -> atualizar nota fiscal
    {
        $notaFiscal = $this->notaFiscalService->updateNotaFiscal(UpdateNotaFiscalDTO::makeFromRequest($request));
        return new UpdateNotaFiscalRequestResource($notaFiscal);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(DeleteNotaFiscalRequest $request) // DELETE -> deletar nota fiscal
    {
        $notaFiscal = $this->notaFiscalService->deleteNotaFiscal(DeleteNotaFiscalDTO::makeFromRequest($request));
        return new DeleteNotaFiscalRequestResource($notaFiscal);
    }
}
