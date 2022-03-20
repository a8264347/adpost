<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoListImages extends Model
{
    use HasFactory;

    protected $table = 'todo-list-images';

    protected $fillable = [
        'todo_list_id',
        'todo_list_images_link'
    ];

    public $timestamps = false;
}