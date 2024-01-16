<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\CreateNotaFiscalNotification;
use App\Notifications\teste;
use Illuminate\Http\Request;

class testeController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User;
    }
    public function teste()
    {
        $user = $this->userModel->create([
            'name' => 'teste',
            'email' => 'caroline2345678913789@gmail.com',
            'password' => 'teste',
            'cpf' => 'etste'
        ]);
        //dd($user->notify(new teste($user)));
        $user->notify(new CreateNotaFiscalNotification($user));
        dd($user);
    }
}
