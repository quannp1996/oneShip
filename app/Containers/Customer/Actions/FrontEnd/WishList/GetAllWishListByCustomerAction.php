<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-28 21:55:41
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-19 22:47:19
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\Actions\FrontEnd\WishList;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

class GetAllWishListByCustomerAction extends Action
{
   

    public function run(int $customerId,string $type,array $with=[], int $limit = 8): ?iterable
    {
        $object = Apiato::call(
            'Customer@WishList\GetAllWishListByCustomerTask',
            [
                $customerId,$type,$limit
            ],
            [
                ['withRelationships'=>[$with]]
            ]
        
        );

        return $object;
    }

}
