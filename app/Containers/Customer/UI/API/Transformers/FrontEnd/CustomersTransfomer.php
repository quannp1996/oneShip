<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-09-07 13:09:51
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-11-16 12:53:26
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\UI\API\Transformers\FrontEnd;

use App\Containers\Customer\Models\Customer;
use App\Ship\Parents\Transformers\Transformer;

class CustomersTransfomer extends Transformer
{
    protected array $defaultIncludes = [];
    
    public function transform(Customer $customer)
    {
        return [
            'id' => $customer->id,
            'email' => $customer->email,
            'fullname' => $customer->fullname,
        ];
    }
}
