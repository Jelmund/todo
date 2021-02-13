<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_show_all_tasks()
    {
        $tasks = Task::factory()->count(5)->create();

        $this->getJson(route('tasks.index'))
            ->assertJson($tasks->toArray());
    }

    /** @test */
    public function it_can_store_a_task()
    {
        $this->withoutExceptionHandling();

        $taskData = [
            'name' => 'Test task',
            'completed' => false
        ];

        $this->postJson(route('tasks.store'), $taskData)
            ->assertCreated();
        $this->assertDatabaseHas('tasks', $taskData);
    }

    /** @test */
    public function it_can_edit_a_task()
    {
        $this->withoutExceptionHandling();

        $task = Task::factory()->create();
        $taskData = [
            'name' => 'Test task',
        ];

        $this->patchJson(route('tasks.update', $task), $taskData)
            ->assertOk();
        $this->assertDatabaseHas('tasks', $taskData);
    }

    /** @test */
    public function it_can_delete_a_task()
    {
        $this->withoutExceptionHandling();

        $task = Task::factory()->create();

        $this->deleteJson(route('tasks.destroy', $task));
        $this->assertDeleted($task);
    }

    /** @test */
    public function it_can_toggle_a_task_as_completed()
    {
        $this->withoutExceptionHandling();
        $task = Task::factory()->create([
            'completed' => false
        ]);

        $this->patchJson(route('tasks.toggle.complete', $task), [
            'completed' => 1
        ]);

        $this->assertDatabaseHas('tasks', [
            'name' => $task['name'],
            'completed' => true
        ]);
    }
}
