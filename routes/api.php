<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookTypeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookAuthorController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('authors', AuthorController::class);
Route::apiResource('book-types', BookTypeController::class);
Route::apiResource('books', BookController::class);
Route::apiResource('book-authors', BookAuthorController::class);
