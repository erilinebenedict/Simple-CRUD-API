<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\studentController;
use App\Http\Requests\studentRequest;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/single{firstname}',static function (){
//     dd('Bingo');
// });


Route::post('/create', [studentController::class, 'createStudent']);

Route::get('/register', [studentController::class, 'studentRegistration']);

Route::get('/list', [studentController::class, 'listRegisteredStudent']);

Route::get('/single/{id}', [studentController::class, 'getSingleRegisteredStudent']);

Route::put('/update/{id}', [studentController::class, 'updateRegisteredStudent']);
