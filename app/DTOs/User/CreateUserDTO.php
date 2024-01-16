<?php

namespace App\DTOs\User;

use App\Http\Requests\User\CreateUserRequest;

class CreateUserDTO
{
    public function __construct(
        public $name,
        public $email,
        public $cpf,
        public $password
    ) {

    }
    public static function makeFromRequest(CreateUserRequest $request): self
    {
        return new self(
            $request->name,
            $request->email,
            $request->cpf,
            $request->password
        );
    }
}
