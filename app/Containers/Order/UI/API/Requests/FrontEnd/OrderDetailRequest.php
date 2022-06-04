<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-21 12:39:00
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-30 12:02:15
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\UI\API\Requests\FrontEnd;

use App\Containers\Order\Models\Order;
use App\Ship\Parents\Requests\Request;

class OrderDetailRequest extends Request
{
    protected $access = [
        'permissions' => '',
        'roles'       => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var  array
     */
    protected $decode = [];

    /**
     * Defining the URL parameters (e.g, `/user/{id}`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var  array
     */
    protected $urlParameters = [];

    /**
     * @return  array
     */
    public function rules()
    {
        return [
            'token_tracking' => ['required','exists:'.Order::getTableName().',token_tracking']
        ];
    }

    public function messages()
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
