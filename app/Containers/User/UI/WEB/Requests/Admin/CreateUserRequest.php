<?php

namespace App\Containers\User\UI\WEB\Requests\Admin;

use App\Ship\Parents\Requests\Request;

/**
 * Class CreateUserRequest.
 */
class CreateUserRequest extends Request
{

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'permissions' => 'update-users',
        'roles'       => 'admin',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var  array
     */
    protected $decode = [
        'roles_ids.*',
        'permissions_ids.*'
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
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:40',
            'password_confirm'         => 'same:password',
            'name'     => 'required|min:2|max:100',
            // 'phone'    => 'required|unique:users,phone',
            'phone'    => 'required|numeric',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Vui lòng nhập Email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã được sử dụng, vui lòng chọn email khác',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu tối thiểu 6 ký tự',
            'password.max' => 'Mật khẩu tối đa 40 ký tự',
            'password_confirm.same' => 'Xác thực mật khẩu không đúng',
            'name.required' => 'Vui lòng nhập Họ tên',
            'name.min' => 'Họ tên tối thiểu 2 ký tự',
            'name.max' => 'Họ tên tối đa 100 ký tự',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.numeric' => 'Số điện thoại chỉ được phép nhập số',
        ];
    }

    /**
     * @return  bool
     */
    public function authorize()
    {
        return $this->check([
            'hasAccess',
        ]);
    }
}
