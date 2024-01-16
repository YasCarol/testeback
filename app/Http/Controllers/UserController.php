<?php

namespace App\Http\Controllers;

use App\DTOs\User\CreateUserDTO;
use App\Http\Requests\User\CreateUserRequest;
use Illuminate\Http\Request;
use App\Http\Resources\User\CreateUserRequestResource;
use App\Services\UserService;

class UserController extends Controller
{

    private $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateUserRequest $request) // cadastro do usuario
    {
        $user = $this->userService->newUser(CreateUserDTO::makeFromRequest($request));
        return new CreateUserRequestResource($user);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
