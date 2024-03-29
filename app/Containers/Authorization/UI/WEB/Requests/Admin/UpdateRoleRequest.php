<?php

namespace App\Containers\Authorization\UI\WEB\Requests\Admin;

use App\Ship\Parents\Requests\Request;

/**
 * Class CreateRoleRequest.
 *
 */
class UpdateRoleRequest extends Request
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
        'id',
    ];

    /**
     * Defining the URL parameters (`/stores/999/items`) allows applying
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
            'id'           => 'required',
            'permissions_ids'   => 'required',
            'description'  => 'required|max:255',
            'display_name' => 'max:100',
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
            'id.required'  => 'ID Role không tồn tại',
            'id.exists'  => 'ID Role không tồn tại',
            'permissions_ids.required' => 'Hãy chọn quyền hạn cho Role',
            'description.required' => 'Hãy nhập mô tả',
            'description.max' => 'Độ dài tối đa 255 ký tự cho trường Mô tả',
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
