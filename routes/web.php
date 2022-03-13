<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TypeBooksController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layouts.master');
});

// Books
// Route::get('/books' , [BooksController::class , 'index']);


// localhost:8000/books
Route::group(['prefix' => 'books'] , function(){
    Route::get('/' , [BooksController::class , 'index']);
    Route::get('/edit/{id?}' , [BooksController::class , 'edit']);
    Route::get('/search' , [BooksController::class , 'search']);
    Route::post('/search' , [BooksController::class , 'search']);
    Route::post('/update' , [BooksController::class , 'update']);
    Route::post('/create' , [BooksController::class , 'create']);
    Route::get('/destroy/{id}' , [BooksController::class , 'destroy']);
});


// TypeBooks
Route::group(['prefix' => 'typebooks'] , function(){
    Route::get('/' , [TypeBooksController::class , 'index']);
    Route::get('/edit/{id?}' , [TypeBooksController::class , 'edit']);
    Route::get('/search' , [TypeBooksController::class , 'search']);
    Route::post('/search' , [TypeBooksController::class , 'search']);
    Route::post('/update' , [TypeBooksController::class , 'update']);
    Route::post('/create' , [TypeBooksController::class , 'create']);
    Route::get('/destroy/{id}' , [TypeBooksController::class , 'destroy']);
});


//Home

Route::get('/home'  , [HomeController::class , 'index']);

Route::get('/customer' , function(){
    return view('customer.index');
});

// v-model  ->  ng-model    =>   
// v-bind   ->  ng-bind     =>   