<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-24 22:40:42
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-13 12:09:10
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\Actions\FrontEnd\WishList;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;

class DeleteWishListAction extends Action
{
    public function run($product_id)
    {
        $object = Apiato::call(
            'Customer@WishList\DeleteWishListTask',
            [
                $product_id
            ]
        );

        return $object;
    }
}
