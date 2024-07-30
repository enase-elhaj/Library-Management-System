<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookController;
use App\Http\Controllers\PatronController;
use App\Http\Controllers\BorrowingController;
use App\Http\Middleware\BasicAuthMiddleware;
use App\Http\Middleware\LogMiddleware;

Route::middleware([BasicAuthMiddleware::class, LogMiddleware::class])->group(function () {

Route::apiResource('books', BookController::class);
Route::apiResource('patrons', PatronController::class);



Route::post('borrow/{bookId}/patron/{patronId}', [BorrowingController::class, 'borrow']);
Route::put('return/{bookId}/patron/{patronId}', [BorrowingController::class, 'returnBook']);
});
