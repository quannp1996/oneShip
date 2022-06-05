<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-08-24 22:40:42
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-10-13 12:09:10
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\Actions\FrontEnd\WishList;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;

class CreatedWishListAction extends Action
{
    public function run($data)
    {
        $object = Apiato::call(
            'Customer@WishList\CreateWishListTask',
            [
                $data
            ]
        );

        return $object;
    }
}
