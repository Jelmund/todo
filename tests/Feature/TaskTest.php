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

        $this->getJson(route('task.index'))
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

        $this->postJson(route('task.store'), $taskData)
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

        $this->patchJson(route('task.update', $task), $taskData)
            ->assertOk();
        $this->assertDatabaseHas('tasks', $taskData);
    }

    /** @test */
    public function it_can_delete_a_task()
    {
        $this->withoutExceptionHandling();

        $task = Task::factory()->create();

        $this->deleteJson('tasks.delete', $task)
            ->assertOk();
        $this->assertDatabaseMissing('tasks', $task);
    }

    /** @test */
    public function it_can_toggle_a_task_its_status()
    {
        $this->withoutExceptionHandling();

        $task = Task::factory()->create([
            'completed' => false
        ]);

        $this->putJson(route('task.toggle.complete', $task), [
            'completed' => true
        ])->assertOk();

        $this->assertDatabaseHas('tasks', [
            'name' => $task['name'],
            'completed' => true
        ]);
    }
}
