<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-17 17:14:35
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-17 17:24:18
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\Tasks\DeliveryType;

use App\Containers\Settings\Data\Repositories\DeliveryTypeDescRepository;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteDeliveryTypeDescTask extends Task
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
    public function run($banner_id)
    {
        try {
            $this->repository->getModel()->where('banner_id', $banner_id)->delete();
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
