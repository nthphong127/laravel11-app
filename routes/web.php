<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/format-html', function () {
        return view('feature.format-html');
    });
    Route::get('/format-json', function () {
        return view('feature.format-json');
    });
    Route::get('/format-sql', function () {
        return view('feature.format-sql');
    });
});

require __DIR__ . '/auth.php';
