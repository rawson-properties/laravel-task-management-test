<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    /**
     * Get all task belonging to a user
     */
    public function index(User $user): JsonResponse
    {
        $tasks = Cache::remember("tasks-$user->id", now()->addHour(), function () use ($user) {
            return $user->tasks;
        });

        return response()->json($tasks);
    }

    /**
     * Show a single task belonging to a user
     */
    public function show(User $user, Task $task): JsonResponse
    {
        return response()->json($task);
    }

    /**
     * Created a task for a specific user
     */
    public function store(User $user, TaskCreateRequest $request): JsonResponse
    {
        $data = $request->only([
            'title',
            'description',
            'due_date',
        ]);

        $task = $user->tasks()->create($data);

        return response()->json($task, Response::HTTP_CREATED);
    }

    public function update(User $user, Task $task, TaskUpdateRequest $request): JsonResponse
    {
        $data = $request->only([
            'title',
            'description',
            'due_date',
        ]);

        $task->update($data);

        return response()->json($task);
    }

    public function destroy(User $user, Task $task): JsonResponse
    {
        $task->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
