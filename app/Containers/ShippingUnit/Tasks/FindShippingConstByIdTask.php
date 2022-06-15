<?php

namespace App\Containers\ShippingUnit\Tasks;

use Apiato\Core\Traits\withDataTrait;
use App\Containers\ShippingUnit\Data\Repositories\ShippingConstRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindShippingConstByIdTask extends Task
{
    use withDataTrait;
    protected $repository;

    public function __construct(ShippingConstRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->find($id);
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
