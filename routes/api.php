<?php

use App\Http\Controllers\API\BooksControllerAPI;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\API\TypebookControllerAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/customers' , [CustomerController::class , 'index']);
Route::post('/customers' , [CustomerController::class , 'store']);
Route::get('/customers/{id}' , [CustomerController::class , 'show']);
Route::put('/customers/{id}' , [CustomerController::class , 'update']);
Route::delete('/customers/{id}' , [CustomerController::class , 'destroy']);

Route::get('/books/{id?}' , [BooksControllerAPI::class , 'books_list']);
Route::post('/books/search' , [BooksControllerAPI::class , 'search']);
Route::get('/typebook' , [TypebookControllerAPI::class  , 'typebook_list']);
// Route::resource('/books' , BooksControllerAPI::class);