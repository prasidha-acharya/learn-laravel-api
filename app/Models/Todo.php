<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    //
        protected $fillable = [
        'title',
        'description',
        'is_completed',
        'user_id'
        ];

        protected $cast = [
            'is_completed'=>'boolean',
        ];
}
