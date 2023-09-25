<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_user_registration()
    {
        $response = $this->registerUser();
        $response->assertStatus(ResponseAlias::HTTP_CREATED);
    }

    /**
     * @return void
     */
    public function test_user_login()
    {
        $this->registerUser();

        $response = $this->loginUser();
        $response->assertStatus(ResponseAlias::HTTP_OK);
    }

    /**
     * @return void
     */
    public function test_create_and_retrieve_tasks()
    {
        $user = $this->registerAndLoginUser();

        $response = $this->createTaskForUser($user);
        $response->assertStatus(ResponseAlias::HTTP_CREATED);

        $task = Task::find($response->json('id'));
        $this->assertEquals('New Task', $task->title);
    }

    /**
     * @return TestResponse
     */
    private function registerUser()
    {
        return $this->postJson(route('user.register'), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'confirm_password' => 'password',
        ]);
    }

    private function loginUser(): TestResponse
    {

        return $this->postJson(route('user.login'), [
            'email' => 'john@example.com',
            'password' => 'password',
        ]);
    }

    private function registerAndLoginUser(): User
    {
        $this->registerUser();
        $this->loginUser();

        $user = User::where('email', 'john@example.com')->first();
        Sanctum::actingAs($user);

        return $user;
    }

    private function createTaskForUser($user): TestResponse
    {
        return $this->postJson(route('user.tasks.store', ['user' => $user->id]), [
            'title' => 'New Task',
            'description' => 'Description for the new task',
            'due_date' => now()->addDay()->toDateString(),
        ]);
    }
}
