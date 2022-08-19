<?php

use App\Http\Controllers\UserController;
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

 //Route pour l'inscription
Route::post("/register", [UserController::class, "register"]);
//Route pour la connexion
Route::get("/login", [UserController::class, "login"]);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
