<?php

namespace App\Containers\Customer\UI\WEB\Requests;

use App\Ship\core\Traits\HelpersTraits\SecurityTrait;
use App\Ship\Parents\Requests\Request;

/**
 * Class CreateCustomerRequest.
 */
class CreateCustomerRequest extends Request
{
    use SecurityTrait;
    /**
     * The assigned Transporter for this Request
     *
     * @var string
     */
    // protected $transporter = \App\Ship\Transporters\DataTransporter::class;

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
        // 'id',
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        return [
          'email'    => 'email|unique:customer,email',
          'password' => 'required|min:6|max:40',
          'password_confirm' => 'same:password',
          'fullname'     => 'nullable|min:2|max:50',
          'phone'    => 'required|unique:customer,phone',
        //   'customer_group_ids' => 'required',
        //   'customer_group_ids.*' => 'numeric'
        ];
    }

    /**
     * @return  bool
     */
    public function messages() {
      return [
          'email.email' => 'Email không đúng định dạng',
          'email.unique' => 'Email đã được sử dụng',
          'password.required' => 'Mật khẩu là trường bắt buộc',
          'password.min' => 'Mật khẩu phải ít nhất 6 kí tự',
          'password.max' => 'Mật khẩu có tối đa 40 kí tự',
          'password_confirm.same' => 'Nhập lại mật khẩu không đúng',
          'fullname.min' => 'Tên phải có ít nhất 2 kí tự',
          'fullname.max' => 'Tên có nhiều nhất 50 kí tự',
          'phone.unique' => 'Phone đã được sử dụng',
      ];
    }
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
