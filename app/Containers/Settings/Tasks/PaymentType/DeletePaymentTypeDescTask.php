<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-17 17:14:35
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-20 01:26:37
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\Tasks\PaymentType;

use App\Containers\Settings\Data\Repositories\PaymentTypeDescRepository;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeletePaymentTypeDescTask extends Task
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
    public function run($banner_id)
    {
        try {
            $this->repository->getModel()->where('banner_id', $banner_id)->delete();
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
