<?php

namespace App\Services;

use App\Repositories\TodoListImagesRepository;
use App\Repositories\TodoListRepository;

use Illuminate\Support\Facades\DB;

class TodoListService
{
	protected $list_obj;
    protected $images_obj;

    // 透過 DI 注入 Repository
    public function __construct(TodoListImagesRepository $images_obj, TodoListRepository $list_obj)
    {
        $this->list_obj   = $list_obj;
        $this->images_obj = $images_obj;
    }

    public function getListAll()
    {
        return DB::table('todo-list')
                ->leftJoin('todo-list-images', 'todo-list.id', '=', 'todo-list-images.todo_list_id')
                ->get();
    }

    /**
    * images新增
    *
    * @param array $data
    * @return collection
    */

    public function createListImages($data){
        return $this->images_obj->createRecord($data)->id;
    }

    /**
    * list新增
    *
    * @param array $data
    * @return collection
    */

    public function createList($data){
        return $this->list_obj->createRecord($data)->id;
    }

    /**
     * list更新
     *
     * @param integer $id
     * @param array   $data
     * @return collection
     */

    public function updateList($id,$data){
        return $this->list_obj->updateRecord($id,$data);
    }

    /**
     * list刪除
     *
     * @param integer $id
     * @return collection
     */

    public function deleteList($id){
        $result = $this->list_obj->findRecord($id);
        $result->delete();
        
        return $result;
    }

    /**
     * list查詢
     *
     * @param string $id
     * @return collection
     */

    public function readeList($id){
        $list = [];
        if (!empty($id)) {
            $list = $this->list_obj->getWithRecord($id);
        }
        return $list;
    }
}
