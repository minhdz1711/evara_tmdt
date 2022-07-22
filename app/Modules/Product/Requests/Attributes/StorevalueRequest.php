<?php

namespace App\Modules\Product\Requests\Attributes;

use Illuminate\Foundation\Http\FormRequest;

class StorevalueRequest extends FormRequest
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
            'title' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Tên danh mục'
        ];
    }
}
