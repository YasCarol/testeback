<?php

namespace App\Policies;

use App\Http\Requests\NotaFiscal\UpdateNotaFiscalRequest;
use App\Models\NotaFiscal;
use App\Models\User;
use GuzzleHttp\Psr7\Request;

class NotaFiscalPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public static function crudNotaFiscal(User $user, $updateRequest)
    {
        if (NotaFiscal::where('numero', $updateRequest->numero)->where('criador', $updateRequest->header('php-auth-user'))->exists()) {
            return true;
        }
        return false;
    }
    public static function showNotaFiscal(User $user, $updateRequest)
    {
        if (NotaFiscal::where('criador', $updateRequest->header('php-auth-user'))->exists()) {
            return true;
        }
        return false;
    }
}
