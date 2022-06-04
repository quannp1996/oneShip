<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-17 17:14:35
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-18 12:37:22
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\Tasks\DeliveryType;

use App\Containers\Settings\Data\Repositories\DeliveryTypeRepository;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Arr;

class CreateDeliveryTypeTask extends Task
{

    protected $repository;

    public function __construct(DeliveryTypeRepository $repository)
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
