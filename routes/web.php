<?php

use App\Http\Controllers\QueueController;
use Illuminate\Support\Facades\Route;



Route::get('/', [QueueController::class, 'index'])->name('queue.index');
Route::get('/step2', [QueueController::class, 'step2'])->name('queue.index');
