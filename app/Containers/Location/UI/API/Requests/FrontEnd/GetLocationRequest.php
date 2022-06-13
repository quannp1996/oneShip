<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-09 00:40:03
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-08-29 14:30:47
 * @ Description: Happy Coding!
 */

namespace App\Containers\Location\UI\API\Requests\FrontEnd;

use App\Ship\Parents\Requests\ApiRequest;

class GetLocationRequest extends ApiRequest
{

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'roles' => '',
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
