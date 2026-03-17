<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessagesRequest;
use App\Services\MessagesService;
use App\Models\Messages;

class MessagesController extends Controller
{
    public function __construct(protected MessagesService $service) {}

    public function index()
    {
        $messages = $this->service->getPaginatedMessages();

        return response()->json($messages, 200);
    }

    public function create()
    {
        return response()->json(null, 200);
    }

    public function store(MessagesRequest $request)
    {
        $message = $this->service->createMessage($request->validated());

        return response()->json($message, 201);
    }

    public function show(Messages $message)
    {
        return response()->json($message, 200);
    }

    public function edit(Messages $message)
    {
        return response()->json($message, 200);
    }

    public function update(MessagesRequest $request, Messages $message)
    {
        $updatedMessage = $this->service->updateMessage(
            $message,
            $request->validated(),
        );

        return response()->json($updatedMessage, 200);
    }

    public function destroy(Messages $message)
    {
        $this->service->deleteMessage($message);

        return response()->json(null, 204);
    }
}
