<?php

use App\Http\Controllers\categoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [categoryController::class, 'index'])->name('home');
Route::post('/add_task', [categoryController::class, 'add_task'])->name('add_task');
Route::post('/get_task', [categoryController::class, 'get_task'])->name('get_task');
Route::post('/delete', [categoryController::class, 'delete'])->name('delete');
Route::post('/viewTask', [categoryController::class, 'viewTask'])->name('viewTask');
Route::post('/status_change', [categoryController::class, 'status_change'])->name('status_change');
Route::post('/save_task', [categoryController::class, 'save_task'])->name('save_task');
