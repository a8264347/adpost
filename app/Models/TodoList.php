<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TodoList extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'todo-list';
    protected $softDelete = true;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'content',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
