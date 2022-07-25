<?php

namespace App\Modules\Membership\Requests;

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
            'display_name' => 'required',
            'username' => 'required|unique:memberships,username,' . $this->membership,
            'email' => 'required|unique:memberships,email,' . $this->membership,
            'phone' => 'required|numeric|unique:memberships,phone,' . $this->membership,
            'password' => 'required|min:8'
        ];
    }

    public function attributes()
    {
        return [
            'display_name' => 'Tên hiển thị',
            'username' => 'Tên đăng nhập',
            'email' => 'Email',
            'phone' => 'Số điện thoại',
            'password' => 'Mật khẩu'
        ];
    }
}
