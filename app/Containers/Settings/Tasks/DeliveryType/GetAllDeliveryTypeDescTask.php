<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-09-17 17:14:35
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-09-17 17:37:26
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\Tasks\DeliveryType;

use App\Containers\Settings\Data\Repositories\DeliveryTypeDescRepository;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;
use App\Ship\Parents\Tasks\Task;

class GetAllDeliveryTypeDescTask extends Task
{

    protected $repository;

    public function __construct(DeliveryTypeDescRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     *
     * @return  mixed
     */
    public function run($id)
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria('delivery_type_id', $id));
        $wery = $this->repository->all()->keyBy('language_id')->toArray();

        return $wery;
    }
}
