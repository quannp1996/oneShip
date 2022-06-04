<?php

namespace App\Containers\Customer\UI\WEB\Requests;

use App\Ship\core\Traits\HelpersTraits\SecurityTrait;
use App\Ship\Parents\Requests\Request;

/**
 * Class CreateCustomerGroupRequest.
 */
class StoreCustomerGroupRequest extends Request
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
            'title' => 'required|max:255',
            'sort' => 'required',
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

    protected function prepareForValidation() {
      $this->merge([
        'status' => 1,
        'title' => $this->cleanXSS($this->title),
        'sort' => $this->cleanXSS($this->sort)
      ]);
    }
}
