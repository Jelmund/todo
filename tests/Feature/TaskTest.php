<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_store_a_task()
    {
        $this->withoutExceptionHandling();

        $data = [
            'name' => 'Test task',
            'completed' => false
        ];

        $this->postJson(route('task.store'), $data)
            ->assertCreated();
        $this->assertDatabaseHas('tasks', $data);
    }
}
