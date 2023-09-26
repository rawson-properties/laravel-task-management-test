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
     * Get all tasks belonging to a user.
     *
     * @param User $user The user whose tasks are to be retrieved.
     * @return JsonResponse
     */
    public function index(User $user): JsonResponse
    {
        // Retrieve the user's tasks from the cache or the database.
        $tasks = Cache::remember("tasks-$user->id", now()->addHour(), function () use ($user) {
            return $user->tasks;
        });

        return response()->json($tasks);
    }

    /**
     * Show a single task belonging to a user.
     *
     * @param User $user The user who owns the task.
     * @param Task $task The task to be shown.
     * @return JsonResponse
     */
    public function show(User $user, Task $task): JsonResponse
    {
        return response()->json($task);
    }

    /**
     * Create a task for a specific user.
     *
     * @param User $user The user for whom the task is created.
     * @param TaskCreateRequest $request The request containing task creation data.
     * @return JsonResponse
     */
    public function store(User $user, TaskCreateRequest $request): JsonResponse
    {
        $data = $request->only([
            'title',
            'description',
            'due_date',
        ]);

        // Create a new task associated with the user.
        $task = $user->tasks()->create($data);

        return response()->json($task, Response::HTTP_CREATED);
    }

    /**
     * Update a task for a specific user.
     *
     * @param User $user The user who owns the task.
     * @param Task $task The task to be updated.
     * @param TaskUpdateRequest $request The request containing task update data.
     * @return JsonResponse
     */
    public function update(User $user, Task $task, TaskUpdateRequest $request): JsonResponse
    {
        $data = $request->only([
            'title',
            'description',
            'due_date',
        ]);

        // Update the task's attributes.
        $task->update($data);

        return response()->json($task);
    }

    /**
     * Delete a task for a specific user.
     *
     * @param User $user The user who owns the task.
     * @param Task $task The task to be deleted.
     * @return JsonResponse
     */
    public function destroy(User $user, Task $task): JsonResponse
    {
        // Delete the task.
        $task->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
