<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name("welcomePage");
Route::resource("users",UserController::class);
Route::delete("users",[UserController::class,"clear"])->name("users.clear");
Route::resource("posts",PostController::class);
Route::delete("posts",[PostController::class,"clear"])->name("posts.clear");
