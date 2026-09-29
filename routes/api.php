<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::get('/hello', function () {
//     return response()->json([
//         'message' => 'Hello from Laravel'
//     ]);
// });

Route::get('/todos', [TodoController::class, 'index']);
Route::post('/todos', [TodoController::class, 'create']); 
Route::patch('/todos/{todoId}', [TodoController::class, 'update']);
Route::delete('/todos/{todoId}', [TodoController::class, 'delete']);
