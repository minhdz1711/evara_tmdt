<?php

namespace App\Modules\Roles\Requests;

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
            'display_name'=>'required|unique:roles,display_name'
        ];
    }

    public function attributes()
    {
        return [
            'display_name'=>'Tên nhóm phân quyền'
        ];
    }
}
