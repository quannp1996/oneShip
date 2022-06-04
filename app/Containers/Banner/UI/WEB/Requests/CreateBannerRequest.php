<?php

namespace App\Containers\Banner\UI\WEB\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class CreateBannerRequest.
 *
 */
class CreateBannerRequest extends Request
{

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'roles'       => 'admin',
        'permissions' => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var  array
     */
    protected $decode = [];

    /**
     * Defining the URL parameters (`/stores/999/items`) allows applying
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
        'image' => 'bail|required|mimes:jpeg,jpg,png,gif',
        'position' => 'bail|required',
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
        'image.mimes' => 'Ảnh banner không đúng định dạng (jpeg, jpg, png, gif)',
        'position.required' => 'Vui lòng chọn vị trí hiển thị'
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
