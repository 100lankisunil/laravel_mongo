<?php

use App\Http\Controllers\categoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [categoryController::class, 'index'])->name('home');
Route::post('/add_task', [categoryController::class, 'add_task'])->name('add_task');
Route::post('/get_task', [categoryController::class, 'get_task'])->name('get_task');
Route::post('/delete', [categoryController::class, 'delete'])->name('delete');
