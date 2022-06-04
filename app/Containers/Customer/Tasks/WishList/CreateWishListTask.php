<?php

namespace App\Containers\Customer\Tasks\WishList;

use App\Containers\Customer\Data\Repositories\CustomerWishListRepository;
use App\Ship\Parents\Tasks\Task;
use Exception;

/**
 * Class CreateCustomerTask.
 */
class CreateWishListTask extends Task
{

    protected $repository;

    public function __construct(CustomerWishListRepository $repository)
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
