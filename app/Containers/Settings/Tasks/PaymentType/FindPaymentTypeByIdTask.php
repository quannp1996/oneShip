<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-17 17:14:35
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-20 01:28:18
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\Tasks\PaymentType;

use App\Containers\Settings\Data\Repositories\PaymentTypeRepository;
use App\Ship\Parents\Tasks\Task;

class FindPaymentTypeByIdTask extends Task
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
    public function run($banner_id, $defaultLanguage = 1, $external_data = ['with_relationship' => ['all_desc']])
    {
        
        $data = $this->repository->with(array_merge($external_data['with_relationship']))->find($banner_id);
        
        return $data;
    }
}