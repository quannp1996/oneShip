<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-17 17:14:35
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-20 01:28:54
 * @ Description: Happy Coding!
 */


namespace App\Containers\Settings\Tasks\PaymentType;

use App\Containers\Settings\Data\Repositories\PaymentTypeRepository;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Arr;

class SavePaymentTypeTask extends Task
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
    public function run(array $data)
    {
        try {
            $dataUpdate = Arr::except($data, ['description', '_token', '_headers']);

            $object = $this->repository->update($dataUpdate, $data['id']);

            return $object;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
