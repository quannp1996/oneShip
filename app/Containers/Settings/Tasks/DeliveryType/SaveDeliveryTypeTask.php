<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-17 17:14:35
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-20 17:19:44
 * @ Description: Happy Coding!
 */


namespace App\Containers\Settings\Tasks\DeliveryType;

use App\Containers\Settings\Data\Repositories\DeliveryTypeRepository;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Arr;

class SaveDeliveryTypeTask extends Task
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
    public function run(array $data)
    {
        try {
            $dataUpdate = Arr::except($data, ['description', '_token', '_headers']);

            $dataUpdate['shipping_fee'] = intval(str_replace([',', '.'], '', $dataUpdate['shipping_fee']));
            $dataUpdate['min_order_free_ship'] = intval(str_replace([',', '.'], '', $dataUpdate['min_order_free_ship']));

            $object = $this->repository->update($dataUpdate, $data['id']);

            return $object;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
