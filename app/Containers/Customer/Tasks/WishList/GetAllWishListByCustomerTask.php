<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-28 21:46:47
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-18 15:49:33
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\Tasks\WishList;

use App\Containers\Customer\Data\Repositories\CustomerWishListRepository;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;
use App\Ship\Parents\Tasks\Task;
use Exception;

class GetAllWishListByCustomerTask extends Task
{
    protected $repository;

    public function __construct(CustomerWishListRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(int $customerId,  string $type,int $limit): ?iterable
    {
        try {
            $returnData = $this->repository->where('customer_id', $customerId)->where('type', $type)->orderBy('created_at','desc');

            return $returnData->paginate($limit);
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function withRelationships(array $rela): self
    {
        $this->repository->with($rela);
        return $this;
    }

}
