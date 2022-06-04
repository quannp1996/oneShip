<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-24 13:46:00
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-08-24 21:03:29
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\UI\API\Requests\FrontEnd;

use App\Ship\Parents\Requests\Request;

class UpdatePasswordCustomerRequest extends Request
{

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'permissions' => '',
        'roles'       => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var  array
     */
    protected $decode = [
        
    ];

    /**
     * Defining the URL parameters (`/stores/999/items`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var  array
     */
    protected $urlParameters = [
        
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        return [
            'password' => ['required'],
            'password_2' => ['required', 'min:8', 'max:20', 'regex:/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/u'],
            'confirm_password_2' => ['required', 'same:password_2'],
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Mật khẩu cũ là trường bắt buộc',
            'password_2.required' => 'Mật khẩu mới là trường bắt buộc',
            'password_2.min' => 'Mật khẩu mới phải có ít nhất 8 kí tự',
            'password_2.max' => 'Mật khẩu mới nhiều nhất 20 kí tự',
            'password_2.regex' => 'Mật khẩu mới không đúng định dạng: Chữ viết thường, in hoa, số',
            'confirm_password_2.required' => 'Nhập lại mật khẩu là trường bắt buộc',
            'confirm_password_2.same' => 'Nhập lại mật khẩu không đúng',
        ];
    }
    /**
     * @return  bool
     */
    public function authorize()
    {
        return auth('api-customer')->check();
    }
}
