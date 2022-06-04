<?php

namespace App\Containers\Customer\Tasks\CustomerSearch;

use App\Containers\Customer\Data\Repositories\CustomerSearchRepository;
use App\Ship\Parents\Tasks\Task;
use Exception;

/**
 * Class CreateCustomerTask.
 */
class CreateCustomerSearchTask extends Task
{

    protected $repository;

    public function __construct(CustomerSearchRepository $repository)
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
            // dd($data);
            $object = $this->repository->create($data);
            return $object;
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
