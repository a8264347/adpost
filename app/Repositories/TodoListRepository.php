<?php

namespace App\Repositories;

use App\Models\TodoList;
use App\Contracts\RepositoryAbstract;

use Illuminate\Support\Facades\DB;

/**
 * Class ProductRepository.
 */
class TodoListRepository extends RepositoryAbstract
{
    protected $list_obj;

    // 透過 DI 注入 Model
    public function __construct(TodoList $list_obj)
    {
        $this->list_obj = $list_obj;
        parent::__construct();
    }

    public function modelUse(){
        return TodoList::class;
    }

    public function getWithRecord($id){
        return DB::table('todo-list as list')
            ->select(['list.title','list.content','images.id as images_id','images.todo_list_id','images.todo_list_images_link'
            ])
            ->leftjoin('todo-list-images as images', 'images.todo_list_id', '=', 'list.id')
            ->where('list.id', $id)
            ->get();
    }
}
