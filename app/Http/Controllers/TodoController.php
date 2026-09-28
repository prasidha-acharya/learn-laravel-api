<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class TodoController extends Controller
{
    //
    public function  index () {

    $data = DB::table('todos')->latest()->get();
    return response()->json($data);
    }

     public function create(Request $body){
        $data = $body->validate([
            'title' => 'required|string|min:3',
            'description' => 'required|string|min:3',
            'is_completed' => 'boolean',
        ]);

        DB::table('todos')->insert($data + ['user_id' => "1",'created_at' => now(),
        'updated_at' => now(),]);

        return response()->json("created successfully",201);
     }

     public function update(Request $body,$todoId){
     $data = $body->validate([
            'title' => 'sometimes|required|string|min:3',
            'description' => 'sometimes|required|string|min:3',
            'is_completed' => 'sometimes|boolean',
        ]);

       $isUserAvailable = DB::table("todos")->where('id',$todoId)->first();

       if(! $isUserAvailable){
        return response()->json("No user found",404);
       }

        DB::table('todos')->where('id',$todoId)->update($data + ['updated_at' => now()]);
        return response()->json("updated successfully $todoId",201);
     }

   public function delete($todoId)
{
    $isUserAvailable = DB::table('todos')->where('id', $todoId)->first();

    if (! $isUserAvailable) {
        return response()->json("User not found", 404);
    }

    DB::table('todos')->where('id', $todoId)->delete();

    return response()->json("Deleted successfully $todoId", 200);
}
}
