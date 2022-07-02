<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-08-24 21:33:00
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-08-24 21:34:16
 * @ Description: Happy Coding!
 */

namespace App\Containers\Authentication\UI\API\Requests\FrontEnd;

use App\Ship\Parents\Requests\Request;

class RegisterRequest extends Request
{

    protected $access = [
        'permissions' => null
    ];

    protected $decode = [

    ];

    protected $urlParameters = [

    ];

    public function rules()
    {
        return [
            'email'    => 'required|max:40',
            'password' => 'required|max:30',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Hãy nhập số điên thoại/email',
            'password.required' => 'Hãy nhập mật khẩu'
        ];
    }

    public function authorize()
    {
        return $this->check([
            'hasAccess',
        ]);
    }
}
