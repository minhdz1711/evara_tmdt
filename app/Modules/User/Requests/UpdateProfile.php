<?php

namespace App\Modules\User\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfile extends FormRequest
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
            'display_name' => 'required',
            'phone' => 'required|unique:users,phone,' . $this->user,
            'username' => 'required|unique:users,username,' . $this->user,
            'email' => 'required|unique:users,email,' . $this->user,
        ];
    }

    public function attributes()
    {
        return [
            'display_name' => 'Tên hiển thị',
            'phone' => 'Số điện thoại',
            'username' => 'Tên đăng nhập',
            'email' => 'Email',
        ];
    }
}
