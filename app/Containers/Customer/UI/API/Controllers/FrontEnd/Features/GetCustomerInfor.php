<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-24 13:44:12
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-19 20:16:13
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\UI\API\Controllers\FrontEnd\Features;

use Apiato\Core\Transformers\Serializers\ArraySerializer;
use App\Containers\Customer\UI\API\Requests\FrontEnd\EditCustomerInforRequest;
use App\Containers\Customer\UI\API\Transformers\FrontEnd\CustomerPrivateProfileTransformer;

trait GetCustomerInfor
{
    public function getCustomerInfor(EditCustomerInforRequest $request)
    {
        return $this->transform($this->user, CustomerPrivateProfileTransformer::class,[],  [
            'message' => 'Success',
            'status' => true
        ], 'data',new ArraySerializer());
    }
}
