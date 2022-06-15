<?php

namespace App\Containers\ShippingUnit\Tasks;

use Apiato\Core\Traits\withDataTrait;
use App\Containers\ShippingUnit\Data\Repositories\ShippingUnitRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindShippingUnitByIdTask extends Task
{
    use withDataTrait;
    protected $repository;

    public function __construct(ShippingUnitRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->with(['consts', 'services'])->find($id);
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
