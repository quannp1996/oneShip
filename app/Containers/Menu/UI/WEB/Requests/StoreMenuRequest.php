<?php

namespace App\Containers\Menu\UI\WEB\Requests;

use App\Ship\Parents\Requests\Request;
use App\Ship\core\Traits\HelpersTraits\ValidationRequiredMessageByLanguage;

/**
 * Class StoreMenuRequest.
 */
class StoreMenuRequest extends Request
{
    use ValidationRequiredMessageByLanguage;
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
        'roles'       => 'admin',
        'permissions' => '',
    ];
    protected $fieldDesc = 'menu_desc';
    protected $fieldRequired = [
        'name' => 'Tên Menu'
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var  array
     */
    protected $decode = [
        // 'id',
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
            // 'id' => 'required',
            'menu_desc.*.name' => 'required',
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
