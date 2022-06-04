<?php

namespace App\Containers\Authorization\UI\WEB\Requests\Admin;

use App\Ship\Parents\Requests\Request;

/**
 * Class CreateRoleRequest.
 *
 */
class CreateRoleRequest extends Request
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
        'permissions_ids.*',
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
            'permissions_ids'   => 'required',
            'name'         => 'required|unique:roles,name|min:2|max:20|no_spaces',
            'description'  => 'required|max:255',
            'display_name' => 'required|max:100',
            'level' => 'required|numeric'
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
            'permissions_ids.required' => 'Hãy chọn quyền hạn cho Role',
            'description.required' => 'Hãy nhập mô tả',
            'description.max' => 'Độ dài tối đa 255 ký tự cho trường Mô tả',
            'display_name.required' => 'Hãy nhập Tên hiển thị',
            'display_name.max' => 'Độ dài tối đa 100 ký tự cho trường Tên hiển thị',
            'level.required' => 'Hãy nhập Level',
            'level.numeric' => 'Level là 1 số',
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
