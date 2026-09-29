<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\Todo;
use App\Http\Requests\storeTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Resources\TodoResource;



class TodoController extends Controller
{
    //
    public function  index () {
    $data = Todo::all();
    return response()->json(TodoResource::collection($data));
    }

     public function create(storeTodoRequest $body){
        $data = $body->validated();

        Todo::create($data + ['user_id' => "1",'created_at' => now(),
        'updated_at' => now(),]);

        return response()->json("created successfully",201);
     }

     public function update(UpdateTodoRequest $body,$todoId){
       $data = $body->validated();

       $isUserAvailable = Todo::find($todoId);

       if(! $isUserAvailable){
        return response()->json("No user found",404);
       }

        Todo::find($todoId)->update($data + ['updated_at' => now()]);
        return response()->json("updated successfully $todoId",201);
     }

   public function delete($todoId)
{
    $isUserAvailable = Todo::find($todoId);

    if (! $isUserAvailable) {
        return response()->json("User not found", 404);
    }

    Todo::find($todoId)->delete();
    return response()->json("Deleted successfully $todoId", 200);
}
}
