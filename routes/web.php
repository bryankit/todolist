<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('task');
    Route::get('/create', [TaskController::class, 'create'])->name('task.create');
    Route::post('/store', [TaskController::class, 'store'])->name('task.store');
    Route::get('/edit/{id}', [TaskController::class, 'edit'])->name('task.edit');
    Route::put('/update/{id}', [TaskController::class, 'update'])->name('task.update');
    Route::put('/update-status/{id}', [TaskController::class, 'updateStatus'])->name('task.updateStatus');
    Route::put('/update-publish/{id}', [TaskController::class, 'updatePublish'])->name('task.updatePublish');
    Route::put('/delete/{id}', [TaskController::class, 'updateDeleteStatus'])->name('task.updateDeleteStatus');
});

require __DIR__.'/auth.php';