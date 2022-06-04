<?php

namespace App\Containers\Customer\Tasks\CustomerSearch;

use App\Containers\Customer\Data\Repositories\CustomerSearchRepository;
use App\Ship\Parents\Tasks\Task;
use Exception;

/**
 * Class CreateCustomerTask.
 */
class DeleteCustomerSearchTask extends Task
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
    public function run($id)
    {
        try {
            // dd($data);
            $object = $this->repository->where('id',$id)->delete();
            return $object;
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
