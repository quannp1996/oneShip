<?php

namespace App\Containers\Customer\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class DeleteUserRequest.
 *
 * @author Quan NP  <npquan1995@gmail.com>
 */
class APIGetAllCustomerRequest extends Request
{

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'permissions' => '',
        'roles'       => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var  array
     */
    protected $decode = [
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
        return [];
    }

    /**
     * @return  bool
     */
    public function authorize()
    {
        return true;
    }
}
