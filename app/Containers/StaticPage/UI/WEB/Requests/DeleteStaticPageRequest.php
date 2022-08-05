<?php

namespace App\Containers\StaticPage\UI\WEB\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class UpdateNewsRequest.
 *
 */
class DeleteStaticPageRequest extends Request
{

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'roles'       => 'admin',
        'permissions' => 'manage-static-page',
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
        return [
            'id'           => 'required|exists:static_page,_id',
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
            'id.required'  => 'ID không tồn tại',
            'id.exists'  => 'ID không tồn tại',
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
