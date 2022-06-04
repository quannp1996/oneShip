<?php

namespace App\Containers\StaticPage\UI\WEB\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class UpdateNewsRequest.
 *
 */
class UpdateStaticPageRequest extends Request
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
        'id',
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        return [];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'id.required'  => 'ID không tồn tại',
            'id.exists'  => 'ID không tồn tại',
            'image.mimes' => 'Ảnh không đúng định dạng (jpeg, jpg, png, gif)',
            'staticpage_description.1.name.required' => 'Tên Tiếng Việt không được bỏ trống',
            'staticpage_description.2.name.required' => 'Tên Tiếng Anh  không được bỏ trống',
            'staticpage_description.3.name.required' => 'Tên Tiếng Trung không được bỏ trống',
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
