<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;

class NotaFiscal extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'numero',
        'valor',
        'dt_emis',
        'cnpj_remetente',
        'nome_remetente',
        'cnpj_transportador',
        'nome_transportador',
        'criador'
    ];
    public function routeNotificationForMail(Notification $notification): array|string
    {
        // Return email address only...
        return $this->criador;
    }
}
