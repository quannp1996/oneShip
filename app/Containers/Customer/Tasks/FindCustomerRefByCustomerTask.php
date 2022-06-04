<?php

namespace App\Containers\Customer\Tasks;

use App\Containers\Customer\Data\Repositories\CustomerRefRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindCustomerRefByCustomerTask extends Task
{

    protected $repository;

    public function __construct(CustomerRefRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($customer_id,$limitDate)
    {
        try {
            if(!empty($limitDate)){
                $this->repository->whereRaw("DATEDIFF(".date('Y-m-d').",created_at)<".$limitDate);
            }
            return $this->repository->where('customer_id',$customer_id)->orderBy('created_at','desc')->first();
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
