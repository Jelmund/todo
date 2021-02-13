<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreTaskRequest;
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

        Task::create($attributes);
    }
}
