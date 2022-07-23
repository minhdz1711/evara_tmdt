<?php

namespace App\Modules\User\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePassword extends FormRequest
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
            'password_current' => 'required',
            'pw_1' => 'required',
            'pw_2' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'password_current' => 'Mật khẩu cũ',
            'pw_1' => 'Mật khẩu mới',
            'pw_2' => 'Nhập lại mật khẩu'
        ];
    }
}
