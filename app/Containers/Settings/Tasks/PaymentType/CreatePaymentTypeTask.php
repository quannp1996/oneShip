<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-17 17:14:35
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-20 01:26:32
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\Tasks\PaymentType;

use App\Containers\Settings\Data\Repositories\PaymentTypeRepository;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Arr;

class CreatePaymentTypeTask extends Task
{

    protected $repository;

    public function __construct(PaymentTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     *
     * @return  mixed
     */
    public function run($data)
    {
        try {
            $data = Arr::except($data, ['description', '_token', '_headers']);

            $deliveryType = $this->repository->create($data);

            return $deliveryType;
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
