<?php

namespace App\Containers\Settings\UI\WEB\Requests\DeliveryType\Admin;

use App\Containers\Settings\Models\DeliveryType;
use App\Ship\Parents\Requests\Request;

class UpdateDeliveryTypeRequest extends Request
{

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'roles'       => 'admin',
        'permissions' => 'update-delivery-type',
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
            'id'           => 'required|exists:'.DeliveryType::getTableName().',id',
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
