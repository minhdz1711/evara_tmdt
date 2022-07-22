<?php

namespace App\Modules\Product\Requests;

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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:products,title,' . $this->product,
            'content' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Tên sản phẩm',
            'content' => 'Nội dung sản phẩm',
        ];
    }
}
