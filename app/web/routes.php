<?php

use App\Http\Route;

use App\Controllers\HomeController;
Route::get('/', [HomeController::class, 'index']);

use App\Controllers\BlogController;
Route::get('/blog', [BlogController::class, 'index']);
Route::get('/blog/category/{id}', [BlogController::class, 'category']);
Route::get('/blog/post/{id}', [BlogController::class, 'show']);
Route::get('/blog/create', [BlogController::class, 'create']);
Route::post('/blog/create', [BlogController::class, 'store']);
Route::get('/blog/edit/{id}', [BlogController::class, 'edit']);
Route::post('/blog/edit/{id}', [BlogController::class, 'update']);
Route::post('/blog/destroy/{id}', [BlogController::class, 'destroy']);