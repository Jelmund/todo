<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::patch('task/toggle/{task}', [TaskController::class, 'toggleComplete'])->name('task.toggle.complete');
Route::resource('task', TaskController::class)
    ->except('create', 'show', 'edit');

