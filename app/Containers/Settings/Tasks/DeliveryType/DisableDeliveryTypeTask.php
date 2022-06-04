<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-17 17:14:35
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-17 17:57:18
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\Tasks\DeliveryType;

use App\Containers\Settings\Data\Repositories\DeliveryTypeRepository;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DisableDeliveryTypeTask extends Task
{
    protected $repository;

    public function __construct(DeliveryTypeRepository $repository)
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
