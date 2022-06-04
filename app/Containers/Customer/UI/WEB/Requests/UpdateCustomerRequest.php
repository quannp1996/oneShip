<?php

namespace App\Containers\Customer\UI\WEB\Requests;

use App\Ship\core\Traits\HelpersTraits\SecurityTrait;
use App\Ship\Parents\Requests\Request;

/**
 * Class UpdateCustomerRequest.
 */
class UpdateCustomerRequest extends Request
{
  use SecurityTrait;
    /**
     * The assigned Transporter for this Request
     *
     * @var string
     */
    // protected $transporter = \App\Containers\Customer\Data\Transporters\::class;

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'permissions' => 'manage-owner',
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
     * Defining the URL parameters (e.g, `/user/{id}`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var  array
     */
    protected $urlParameters = [
        'id',
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        return [
            'id' => 'required',
            'email' => 'required|email|unique:customer,email,'.request('id'),
            'password' => 'nullable|min:6|max:40',
            'password_confirm' => 'same:password',
            'fullname'     => 'nullable|min:2|max:50',
            'phone'    => [ 'required', 'regex:/^(02|03|04|05|06|07|09|08|01[2|6|8|9])+([0-9]{8})$/', 'unique:customer,phone,'.request('id') ],
        ];
    }
    public function messages() {
      return [
        'id' => 'Id là trường bắt buộc',
        'email.required' => 'Email là trường bắt buộc',
        'email.email' => 'Email không đúng định dạng',
        'email.unique' => 'Email đã được sử dụng',
        'password.min' => 'Mật khẩu phải ít nhất 6 kí tự',
        'password.max' => 'Mật khẩu có tối đa 40 kí tự',
        'password_confirm.same' => 'Nhập lại mật khẩu không đúng',
        'fullname.min' => 'Tên phải có ít nhất 2 kí tự',
        'fullname.max' => 'Tên có nhiều nhất 50 kí tự',
        'phone.required' => 'Số điện thoại là trường bắt buộc',
        'phone.regex' => 'Số điện thoại không đúng định dạng',
        'phone.unique' => 'Phone đã được sử dụng',
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

    protected function prepareForValidation()
    {
        $this->merge([
          'email' => $this->cleanXSS($this->email),
          'fullname' => $this->cleanXSS($this->fullname),
          'phone' => $this->cleanXSS($this->phone),
        ]);
    }
}
