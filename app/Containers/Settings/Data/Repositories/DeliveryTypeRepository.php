<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-09-17 15:14:16
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-09-17 15:16:29
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

class DeliveryTypeRepository extends Repository
{

    /**
     * the container name. Must be set when the model has different name than the container
     *
     * @var  string
     */
    protected $container = 'Settings';

    /**
     * @var array
     */
    protected $fieldSearchable = [];
}
