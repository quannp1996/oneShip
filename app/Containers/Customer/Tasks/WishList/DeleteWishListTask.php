<?php

namespace App\Containers\Customer\Tasks\WishList;

use App\Containers\Customer\Data\Repositories\CustomerWishListRepository;
use App\Ship\Parents\Tasks\Task;
use Exception;

/**
 * Class CreateCustomerTask.
 */
class DeleteWishListTask extends Task
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
    public function run($product_id)
    {
        try {
            // dd($data);
            $object = $this->repository->where('product_id',$product_id)->delete();
            return $object;
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
