<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\UserController as ControllersUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::get('/users', function (Request $request) {
//     return response()->json([
//         'status' => true,
//         'message' => "Listar usuarios",
//     ], 200);
// });

Route::get('/users', [UserController::class, 'index']); // GET - http://127.0.0.1:8000/api/users?page=1
Route::get('/users/{user}', [UserController::class, 'show']); // GET - http://127.0.0.1:8000/api/users/1
Route::post('/users', [UserController::class, 'store']); // GET - http://127.0.0.1:8000/api/users
Route::put('/users/{user}', [UserController::class, 'update']); // PUT - http://127.0.0.1:8000/api/users/1
Route::delete('/users/{user}', [UserController::class, 'destroy']); // DELETE - http://127.0.0.1:8000/api/users/1