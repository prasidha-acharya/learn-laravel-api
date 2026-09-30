<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\Todo;
use App\Http\Requests\storeTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Resources\TodoResource;

use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    //
    public function  index () {
        $id = Auth::id();
        $data = Todo::where('user_id',$id)->get();
       return response()->json(TodoResource::collection($data));
    }

     public function create(storeTodoRequest $body){
        //validation
        $data = $body->validated();

        // fetched id from Auth user
        $id = Auth::id();

        //created todo in db
        Todo::create($data + ['user_id' => $id,'created_at' => now(),
        'updated_at' => now(),]);

        //sending response 
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
