<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-09 00:40:03
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-04 16:50:59
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\UI\API\Requests\FrontEnd;

use App\Containers\Product\Models\Product;
use App\Ship\Parents\Requests\ApiRequest;

class AddWishListRequest extends ApiRequest
{

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        
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
    protected $urlParameters = [];

    /**
     * @return  array
     */
    public function rules()
    {
        return [
            'product_id' => ['required','exists:'.Product::getTableName().',id']
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
