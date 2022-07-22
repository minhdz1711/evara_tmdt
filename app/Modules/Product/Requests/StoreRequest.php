<?php

namespace App\Modules\Product\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'title' => 'required|unique:products,title',
            'slug' => 'unique:products,slug',
            'content' => 'required',
            'images' => 'required',
            'regular_price' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Tên sản phẩm',
            'content' => 'Nội dung sản phẩm',
            'regular_price' => 'Giá sản phẩm',
            'images' => 'thêm ảnh',
        ];
    }
}
