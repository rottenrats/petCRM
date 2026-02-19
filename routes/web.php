<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\InviteRegisterController;
use App\Http\Controllers\InviteСontroller;
use App\Http\Controllers\Auth\CompanyRegisterController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [CompanyRegisterController::class, 'create'])->name('register');
    Route::post('/register', [CompanyRegisterController::class, 'store']);
});

Route::get('/invite/{token}', [InviteRegisterController::class, 'show'])->name('invite.register.show');
Route::post('/invite/{token}', [InviteRegisterController::class, 'store'])->name('invite.register.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/invite', [InviteСontroller::class, 'create'])->name('invite.create.show');
    Route::post('/invite', [InviteСontroller::class, 'store'])->name('invite.create.store');
});

require __DIR__.'/auth.php';
