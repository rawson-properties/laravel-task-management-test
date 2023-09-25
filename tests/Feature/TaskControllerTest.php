<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_can_get_task_for_a_specific_user_by_scoped_routes()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $this->postJson(route('user.tasks.store', ['user' => $user->id]), [
            'title' => 'New Task 1',
            'description' => 'Description for Task 1',
            'due_date' => now()->addDay(),
        ]);

        $this->postJson(route('user.tasks.store', ['user' => $user->id]), [
            'title' => 'New Task 2',
            'description' => 'Description for Task 2',
            'due_date' => now()->addDays(2),
        ]);

        $this->assertCount(2, Task::all());

        $response = $this->getJson(route('user.tasks.index', ['user' => $user->id]))
            ->assertStatus(ResponseAlias::HTTP_OK);

        $task1 = Task::first();
        $task2 = Task::latest()->first();

        $response->assertJsonFragment(['title' => $task1->title]);
        $response->assertJsonFragment(['title' => $task2->title]);

        $response->assertJsonFragment(['due_date' => $task1->due_date->toISOString()]);
        $response->assertJsonFragment(['due_date' => $task2->due_date->toISOString()]);

    }

    public function test_can_perform_crud_operation_for_tasks()
    {
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
        ]);

        // Authenticate the user
        Sanctum::actingAs($user);

        // Create a new task
        $response = $this->postJson(route('user.tasks.store', ['user' => $user->id]), [
            'title' => 'New Task',
            'description' => 'Description for the new task',
            'due_date' => now()->addDay()->toDateString(),
        ]);

        $response->assertStatus(ResponseAlias::HTTP_CREATED);
        $task = Task::find($response->json('id'));
        $this->assertEquals('New Task', $task->title);

        $response = $this->getJson(route('user.tasks.show', ['user' => $user->id, 'task' => $task->id]));

        $response->assertStatus(ResponseAlias::HTTP_OK);
        $this->assertEquals('New Task', $response->json('title'));

        $response = $this->putJson(route('user.tasks.update', ['user' => $user->id, 'task' => $task->id]), [
            'title' => 'Updated Task',
            'description' => 'Updated description',
            'due_date' => now()->addWeek()->toDateString(),
        ]);

        $response->assertStatus(ResponseAlias::HTTP_OK);
        $updatedTask = Task::find($task->id);
        $this->assertEquals('Updated Task', $updatedTask->title);

        $response = $this->deleteJson(route('user.tasks.destroy', ['user' => $user->id, 'task' => $task->id]));

        $response->assertStatus(ResponseAlias::HTTP_NO_CONTENT);
        $this->assertNull(Task::find($task->id));
    }
}
