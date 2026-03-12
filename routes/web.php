<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProjectController;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('project', ProjectController::class)->middleware(['auth']);

Route::get('/dashboard', [App\Http\Controllers\TestController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/tasks', [TestController::class, 'index'])->name('tasks.index');
    Route::post('/tasks', [TestController::class, 'store'])->name('tasks.store');
    Route::delete('/tasks/{id}', [TestController::class, 'destroy'])->name('tasks.destroy');
    Route::get('/tasks/category/{category}', [TestController::class, 'filter'])->name('tasks.filter');
    Route::get('/tasks/{task}/edit', [TestController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}', [TestController::class, 'update'])->name('tasks.update');
});
require __DIR__.'/auth.php';
