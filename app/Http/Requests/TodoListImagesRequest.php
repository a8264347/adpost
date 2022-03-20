<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoListImagesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'todo_list_id'          => 'required|digits_between:1,20|integer',
            'files'                 => 'required|mimes:jpeg,png,gif|max:3096'
        ];
    }

    public function rule_messages(){
        return [
            'todo_list_id.required'          => 'todo_list_id 必填',
            'todo_list_id.digits_between'    => 'todo_list_id 最多只能20',
            'files.required' => 'files 必填',
            'files.url'      => 'files 格式需為圖片'
        ];
    }
}
