<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserService;
use App\Models\User;

class UserController extends Controller
{
    public function __construct(protected UserService $service) {}

    public function index()
    {
        $users = $this->service->getPaginatedUsers();

        return response()->json($users, 200);
    }

    public function create()
    {
        return response()->json(null, 200);
    }

    public function store(UserRequest $request)
    {
        $user = $this->service->createUser($request->validated());

        return response()->json($user, 201);
    }

    public function show(User $user)
    {
        return response()->json($user, 200);
    }

    public function edit(User $user)
    {
        return response()->json($user, 200);
    }

    public function update(UserRequest $request, User $user)
    {
        $updatedUser = $this->service->updateUser($user, $request->validated());

        return response()->json($updatedUser, 200);
    }

    public function destroy(User $user)
    {
        $this->service->deleteUser($user);

        return response()->json(null, 204);
    }
}

