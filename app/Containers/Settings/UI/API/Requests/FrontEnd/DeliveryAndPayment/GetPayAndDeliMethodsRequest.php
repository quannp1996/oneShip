<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-20 02:43:57
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-20 02:44:39
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\UI\API\Requests\FrontEnd\DeliveryAndPayment;

use App\Ship\Parents\Requests\Request;

class GetPayAndDeliMethodsRequest extends Request
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
        // 'id',
    ];

    /**
     * Defining the URL parameters (e.g, `/user/{id}`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var  array
     */
    protected $urlParameters = [
        //'id',
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        return [
        ];
    }

    /**
     * @return  bool
     */
    public function authorize()
    {
        return true;
    }
}
