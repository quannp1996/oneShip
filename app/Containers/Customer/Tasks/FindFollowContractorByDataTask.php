<?php

namespace App\Containers\Customer\Tasks;

use Exception;
use App\Ship\Parents\Tasks\Task;
use App\Containers\Customer\Models\Customer;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Containers\Customer\Data\Repositories\CustomerRepository;
use App\Ship\Criterias\Eloquent\OrderByCreationDateAscendingCriteria;
use App\Ship\Criterias\Eloquent\OrderByCreationDateDescendingCriteria;
use App\Containers\Customer\Data\Repositories\CustomerFollowRepository;

class FindFollowContractorByDataTask extends Task 
{

    protected $repository;

    public function __construct(CustomerFollowRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $where=[], $request=null)
    {
        try {
            if (!empty($request->sort_by) && $request->sort_by == 'created_at ASC') {
                $this->repository->pushCriteria(new OrderByCreationDateAscendingCriteria());
            }else {
                $this->repository->pushCriteria(new OrderByCreationDateDescendingCriteria());
            }

            return $this->repository->findWhere($where);
        }
        catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}
