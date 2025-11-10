<?php

use App\Http\Controllers\LinkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', [UserController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::get('/link/{id}', [LinkController::class, 'show'])->middleware(['auth'])->name('show.link');
Route::post('/link', [LinkController::class, 'store'])->middleware(['auth'])->name('create.link');
Route::put('/link/{id}', [LinkController::class, 'update'])->middleware(['auth'])->name('update.link');
Route::delete('/link/{id}', [LinkController::class, 'destroy'])->middleware(['auth'])->name('delete.link');

Route::get('/u/{name}', [UserController::class, 'followers'])->name('follower.view');
Route::put('/user/update', [UserController::class, 'update'])->middleware(['auth'])->name('update.user');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
