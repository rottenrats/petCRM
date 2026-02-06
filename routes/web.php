<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\InviteRegisterController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/invite/{token}', [InviteRegisterController::class, 'show'])->name('invite.register.show');
Route::post('/invite/{token}', [InviteRegisterController::class, 'store'])->name('invite.register.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
