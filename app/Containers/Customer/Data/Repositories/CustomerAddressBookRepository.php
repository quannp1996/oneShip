<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-08-28 21:47:58
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-08-28 22:15:11
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

class CustomerAddressBookRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
