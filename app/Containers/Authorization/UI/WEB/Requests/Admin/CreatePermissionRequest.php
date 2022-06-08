<?php

namespace App\Containers\Authorization\UI\WEB\Requests\Admin;

use App\Ship\Parents\Requests\Request;

/**
 * Class CreateRoleRequest.
 *
 */
class CreatePermissionRequest extends Request
{

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'roles'       => 'admin',
        'permissions' => 'manage-roles',
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
            'name'         => 'required|unique:permissions,name|min:2|max:20|no_spaces',
            'description'  => 'required|max:255',
            'containers'   => 'required|max:255',
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
            'name.required'  => 'Hãy nhập tên',
            'name.no_spaces'  => 'Tên không chứa khoảng trắng',
            'name.unique'  => 'Tên này đã tồn tại',
            'name.min'  => 'Độ dài tối thiểu 2 ký tự cho trường Tên',
            'name.max'  => 'Độ dài tối đa 20 ký tự cho trường Tên',
            'description.required' => 'Hãy nhập mô tả',
            'description.max' => 'Độ dài tối đa 255 ký tự cho trường Mô tả',
            'containers' => 'Hãy chọn Container',
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
