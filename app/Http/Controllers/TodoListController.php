<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\TodoListRequest;
use App\Http\Requests\TodoListImagesRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Storage;

use App\Services\TodoListService;

/**
 * @SWG\Swagger(
 *     @OA\Info(title="TodoList api 說明", version="1.0")
 * )
 */

class TodoListController extends Controller
{
    use ApiTrait;

    protected $service;

    public function __construct(TodoListService $service)
    {
        $this->service = $service;
    }
    /**
    * @OA\Get(
    *      path="/api/TodoList",
    *      operationId="todolist",
    *      tags={"TodoList Tag"},
    *      summary="取得代辦事項 Summary",
    *      description="取得代辦事項 Description",
    *      @OA\Response(
    *          response=200,
    *          description="Success."
    *       )
    * )
    * Returns list of todolists
    */
    public function index()
    {
        $list_all = $this->service->getListAll();

        return $this->returnSuccess('Success.', $list_all);
    }

    /**
    * @OA\Post(
    *      path="/api/TodoList",
    *      operationId="TodoListStore",
    *      tags={"TodoList"},
    *      summary="新增代辦事項",
    *      description="新增代辦事項",
    *      @OA\Parameter(
    *          name="title",
    *          description="代辦事項標題",
    *          required=true,
    *          in="query",
    *          @OA\Schema(
    *              type="string"
    *          )
    *      ),
    *      @OA\Parameter(
    *          name="content",
    *          description="代辦事項內容",
    *          required=true,
    *          in="query",
    *          @OA\Schema(
    *              type="string"
    *          )
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="Store Success."
    *       ),
    *      @OA\Response(
    *          response=400,
    *          description="list新增失敗，請重試。"
    *       )
    * )
    * Create a TodoList
    */
    public function store(TodoListRequest $request)
    {
        $data   = $request->only(['title', 'content']);
        $result = $this->service->createList($data);
        if (!$result) {
            return $this->return400Response('list新增失敗，請重試。');
        }
        return $this->returnSuccess('Store Success.', $result);
    }

    /**
    * @OA\Get(
    *      path="/api/TodoList/{id}",
    *      operationId="todolistShow",
    *      tags={"TodoList"},
    *      summary="取得代辦事項詳情",
    *      description="取得代辦事項詳情",
    *      @OA\Parameter(
    *          name="id",
    *          description="TodoList id",
    *          required=true,
    *          in="path",
    *          @OA\Schema(
    *              type="integer"
    *          )
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="Show Success"
    *       ),
    *      @OA\Response(
    *          response=400,
    *          description="無此list或已刪除，請重試。"
    *       )
    * )
    * Show todolists content
    */
    public function show($id)
    {
        $result = $this->service->readeList($id);
        if (empty($result)) {
            return $this->return400Response('無此list或已刪除，請重試。');
        }
        return $this->returnSuccess('Show Success.', $result);
    }

    /**
    * @OA\Patch(
    *      path="/api/TodoList/{id}",
    *      operationId="TodoListUpdate",
    *      tags={"TodoList"},
    *      summary="更新代辦事項",
    *      description="更新代辦事項",
    *      @OA\Parameter(
    *          name="id",
    *          description="TodoList id",
    *          required=true,
    *          in="path",
    *          @OA\Schema(
    *              type="integer"
    *          )
    *      ),
    *      @OA\Parameter(
    *          name="title",
    *          description="代辦事項標題",
    *          required=false,
    *          in="query",
    *          @OA\Schema(
    *              type="string"
    *          )
    *      ),
    *      @OA\Parameter(
    *          name="content",
    *          description="代辦事項內容",
    *          required=false,
    *          in="query",
    *          @OA\Schema(
    *              type="string"
    *          )
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="Update Success."
    *       ),
    *      @OA\Response(
    *          response=400,
    *          description="list更新失敗，請重試。"
    *       )
    * )
    * Update TodoList content
    */
    public function update(TodoListRequest $request, $id)
    {
        $data   = $request->only('title', 'content');
        $result = $this->service->updateList($id,$data);
        if (!$result) {
            return $this->return400Response('list更新失敗，請重試。');
        }
        return $this->returnSuccess('Update Success.', $result);
    }

    /**
    * @OA\Delete(
    *      path="/api/TodoList/{id}",
    *      operationId="TodoListDelete",
    *      tags={"TodoList"},
    *      summary="刪除代辦事項",
    *      description="刪除代辦事項",
    *      @OA\Parameter(
    *          name="id",
    *          description="TodoList id",
    *          required=true,
    *          in="path",
    *          @OA\Schema(
    *              type="integer"
    *          )
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="Delete Success."
    *       ),
    *      @OA\Response(
    *          response=400,
    *          description="無此list，請重試。"
    *       )
    * )
    * Delete TodoList content
    */
    public function destroy($id)
    {
        $result = $this->service->readeList($id);
        if (empty($result)) {
            return $this->return400Response('無此list，請重試。');
        }
        if ($this->service->deleteList($id)) {
            return $this->returnSuccess('Delete Success.', $result);
        }
        return $this->return400Response('Unknown error');
    }

    public function saveListImages(TodoListImagesRequest $request){
        $files   = $request->file('files');
        $list_id = $request->input('todo_list_id', '');
        $result  = [];
        if($request->hasFile('files')){
            foreach ($files as $file) {
                $file_name = $this->saveFile($file, $list_id);
                $data = [
                    'todo_list_id'          => $list_id,
                    'todo_list_images_link' => $file_name
                ];
                $result[] = $this->service->createListImages($data);
            }
            return $this->returnSuccess('檔案上傳成功！', $result);
        }
        return $this->return400Response('無任何檔案上傳。');
    }

    /**
     * 儲存檔案
     *
     * @param UploadedFile $file
     * @return file_name
     */

    private function saveFile(UploadedFile $file, $id){
        $file_name = $id . '-'  . Str::random(8). '-' . $file->getClientOriginalName();
        Storage::put($file_name, $file->get());
        return $file_name;
    }
}
