<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

Route::get('/users',[UserController::class, 'index'])->name('user.index');
Route::get('/user/create',[UserController::class, 'create'])->name('user.create');
Route::post('/user/store',[UserController::class, 'store'])->name('user.store');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
