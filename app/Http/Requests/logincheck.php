<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class logincheck extends FormRequest
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
            //
            'adminuser'=>'required|between:2,6',
            'adminpwd'=>'required|between:2,6',
        ];
    }
    public function messages()
    {
        return [
            'adminuser.required'=>'用户名不能为空',
            'adminuser.between'=>'用户必须为2到6个字段',
            'adminpwd.required'=>'密码不能为空',
            'adminpwd.between'=>'密码长度必须为2到6',
        ];
    }
}
