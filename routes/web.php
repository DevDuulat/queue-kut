<?php

use App\Http\Controllers\QueueController;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Middleware\ThrottleRequests;


Route::get('/', [QueueController::class, 'index'])->name('queue.index');

Route::post('/queue/submit', [QueueController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('queue.submit');

Route::get('/queue/download-ticket', [QueueController::class, 'downloadTicket'])
    ->name('queue.download_ticket');