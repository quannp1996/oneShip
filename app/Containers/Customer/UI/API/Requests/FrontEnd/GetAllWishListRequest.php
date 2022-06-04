<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-24 13:46:00
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-08 22:35:40
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\UI\API\Requests\FrontEnd;

use App\Ship\Parents\Requests\Request;

class GetAllWishListRequest extends Request
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
        
    ];

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
        return [
            
        ];
    }

    /**
     * @return  bool
     */
    public function authorize()
    {
        return true;
        // return auth()->guard(config('auth.guard_for.frontend'))->check();
    }
}
