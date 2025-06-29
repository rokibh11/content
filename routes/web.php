<?php

use App\Http\Controllers\ContentGeneratorController;

Route::get('/', [ContentGeneratorController::class, 'index'])->name('home');
Route::post('/generate', [ContentGeneratorController::class, 'generate'])->name('generate');
Route::get('/history', [ContentGeneratorController::class, 'history'])->name('history');

