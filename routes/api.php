<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\BookResource;
use App\Http\Controllers\bookController;
use App\Models\Book;

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

Route::get('/books', function(){
    return BookResource::collection(Book::all());
});

Route::get('/book/{id}', function($id){
    return new BookResource(Book::findOrFail($id));
});

Route::put('/book/{id}', [bookController::class, 'update']);
Route::delete('/book/{id', [bookController::class, 'destroy']);

Route::post('/book', [bookController::class, 'store']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
