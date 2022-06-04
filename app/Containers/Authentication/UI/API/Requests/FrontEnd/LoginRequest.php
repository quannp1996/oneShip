<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-24 21:33:00
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-08-24 21:34:16
 * @ Description: Happy Coding!
 */

namespace App\Containers\Authentication\UI\API\Requests\FrontEnd;

use App\Ship\Parents\Requests\Request;

class LoginRequest extends Request
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
            'username'    => 'required|max:40',
            'password' => 'required|max:30',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Hãy nhập số điên thoại/email',
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
