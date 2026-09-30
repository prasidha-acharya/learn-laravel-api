<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\AuthController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::get('/hello', function () {
//     return response()->json([
//         'message' => 'Hello from Laravel'
//     ]);
// });

Route::get('/todos', [TodoController::class, 'index'])->middleware('auth:sanctum');
Route::post('/todos', [TodoController::class, 'create'])->middleware('auth:sanctum'); 
Route::patch('/todos/{todoId}', [TodoController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/todos/{todoId}', [TodoController::class, 'delete'])->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']); 
Route::post('/login', [AuthController::class, 'login']); 

