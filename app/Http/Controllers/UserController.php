<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(protected UserService $service) {}

    public function index(): JsonResponse
    {
        $users = $this->service->getPaginatedUsers();

        return response()->json($users, 200);
    }

    public function create(): JsonResponse
    {
        return response()->json(null, 200);
    }

    public function store(UserRequest $request): JsonResponse
    {
        $user = $this->service->createUser($request->validated());

        return response()->json($user, 201);
    }

    public function show(User $user): JsonResponse
    {
        return response()->json($user, 200);
    }

    public function edit(User $user): JsonResponse
    {
        return response()->json($user, 200);
    }

    public function update(UserRequest $request, User $user): JsonResponse
    {
        $updatedUser = $this->service->updateUser($user, $request->validated());

        return response()->json($updatedUser, 200);
    }

    public function destroy(User $user): JsonResponse
    {
        $this->service->deleteUser($user);

        return response()->json(null, 204);
    }
}
