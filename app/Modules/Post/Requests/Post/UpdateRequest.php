<?php

namespace App\Modules\Post\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title' => 'required|unique:posts,title,'.$this->post,
            'content' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Tiêu đề bài viết',
            'content' => 'Nội dung bài viết'
        ];
    }
}
