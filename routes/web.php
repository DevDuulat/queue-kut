<?php

use App\Http\Controllers\QueueController;
use Illuminate\Support\Facades\Route;



Route::get('/', [QueueController::class, 'index'])->name('queue.index');
Route::post('/queue/submit', [QueueController::class, 'store'])
    ->name('queue.submit');
