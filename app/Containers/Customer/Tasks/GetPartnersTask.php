<?php

namespace App\Containers\Customer\Tasks;

use App\Containers\Contractor\Data\Repositories\ContractorRepository;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class GetPartnersTask extends Task
{

    protected $repository;

    public function __construct(ContractorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(int $customerID, array $selectColumn = ['*'])
    {
        try {
            return $this->repository->select($selectColumn)->whereHas('buildings', function($query) use($customerID) {
                $query->where('construction.owner_id', $customerID);
            })->get();
        }
        catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
