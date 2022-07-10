<?php

namespace App\Containers\Authentication\UI\WEB\Requests\FrontEnd;

use App\Ship\Parents\Requests\Request;

/**
 * Class WEBRegisterRequest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class WEBRegisterRequest extends Request
{

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'permissions' => null
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'    => ['required', 'max:40', 'email', 'unique:customer,email'],
            'password' => 'required|max:30',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Hãy nhập số điên thoại/email',
            'email.unique' => 'Email đã được sử dụng',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Hãy nhập mật khẩu'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->check([
            'hasAccess',
        ]);
    }
}
