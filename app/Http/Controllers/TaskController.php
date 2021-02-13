<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use Illuminate\Support\Collection;

use App\Models\Task;


class TaskController extends Controller
{
    public function index(): Collection
    {
        return Task::all();
    }

    public function store(StoreTaskRequest $request)
    {
        $attributes = $request->validated();

        return Task::create($attributes);
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $attributes = $request->validated();

        return $task->update($attributes);
    }
}
