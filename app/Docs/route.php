//...
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
//...
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
//...
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
//...
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
//...
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