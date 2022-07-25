<?php

namespace App\Modules\Pages\Requests;

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
            'title' => 'required|unique:pages,title,' . $this->page,
            'content' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Tên trang tĩnh',
            'content' => 'Nội dung trang tĩnh',
        ];
    }
}
