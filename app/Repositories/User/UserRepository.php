<?php

namespace App\Repositories\User;

use App\DTOs\User\CreateUserDTO;
use App\Models\User;
use App\Notifications\CreateNotaFiscalNotification;

class UserRepository
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User;
    }
    public function create(CreateUserDTO $dto)
    {
        $user = $this->userModel->create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => $dto->password,
            'cpf' => $dto->cpf
        ]);
        return $user;
    }
}
