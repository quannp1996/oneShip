<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-17 17:14:35
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-20 01:27:59
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\Tasks\PaymentType;

use App\Containers\Settings\Data\Repositories\PaymentTypeRepository;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DisablePaymentTypeTask extends Task
{
    protected $repository;

    public function __construct(PaymentTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($banner_id)
    {
        try {
            $this->repository->getModel()->where('id', $banner_id)->update(
                [
                    'status' => 1
                ]
            );
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
