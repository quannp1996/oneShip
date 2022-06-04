<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-17 17:14:35
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-20 01:38:18
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\Tasks\PaymentType;

use App\Containers\Settings\Data\Repositories\PaymentTypeDescRepository;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;
use App\Ship\Parents\Tasks\Task;

class GetAllPaymentTypeDescTask extends Task
{

    protected $repository;

    public function __construct(PaymentTypeDescRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     *
     * @return  mixed
     */
    public function run($id)
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria('payment_type_id', $id));
        $wery = $this->repository->all()->keyBy('language_id')->toArray();

        return $wery;
    }
}
