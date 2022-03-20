<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoListRequest extends FormRequest
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
            'title'     => 'required|max:255|string',
            'content'   => 'required|string'
        ];
    }

    public function rule_messages(){
        return [
            'title.required'        => 'title 必填',
            'title.max'             => 'title 不得超過255',
            'title.string'          => 'title 只能是字串',
            'content.required'      => 'content 必填',
            'content.string'        => 'content 只能是字串'
        ];
    }
}
