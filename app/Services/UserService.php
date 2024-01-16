<?php

namespace App\Services;

use App\DTOs\User\CreateUserDTO;
use App\Repositories\User\UserRepository;
use App\Notifications\CreateNotaFiscalNotification;

class UserService
{

    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository;
    }

    public function newUser(CreateUserDTO $dto)
    {
        $user = $this->userRepository->create($dto);
       // $user->notify(new CreateNotaFiscalNotification($user));
        return $user;
    }
}
