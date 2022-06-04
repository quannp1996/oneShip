<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-28 21:46:47
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-18 15:49:33
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\Tasks;

use App\Containers\Customer\Data\Repositories\CustomerAddressBookRepository;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CusGetAllAddBookTask extends Task
{
    protected $repository;

    public function __construct(CustomerAddressBookRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(int $customerId, int $limit, bool $skipPagin = true, array $externalData = [], int $currentPage = 1): ?iterable
    {
        try {
            $returnData = $this->repository->where('customer_id', $customerId);

            return $skipPagin ? $returnData->get() : $returnData->paginate($limit);
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function withRelationships(array $rela): self
    {
        $this->repository->with($rela);
        return $this;
    }

    public function status(int $status): self
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria('status', $status));
        return $this;
    }

    public function isDefault(): self
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria('is_default',1));
        return $this;
    }
}
