<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-28 21:46:47
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-18 15:49:33
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\Tasks\CustomerSearch;

use App\Containers\Customer\Data\Repositories\CustomerSearchRepository;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;
use App\Ship\Parents\Tasks\Task;
use Exception;

class GetKeySearchByCustomerTask extends Task
{
    protected $repository;

    public function __construct(CustomerSearchRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(int $customerId): ?iterable
    {
        try {
            $returnData = $this->repository->where('customer_id', $customerId)->orderBy('created_at','desc')->get();
          
            return  $returnData;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

}
