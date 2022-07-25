<?php

namespace App\Modules\Menu\Requests\MenuPosition;

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
            'title' => 'required|unique:menu_positions,title,'.$this->menu_position
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Tên vị trí'
        ];
    }
}
