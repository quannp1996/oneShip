<?php

namespace App\Containers\ShippingUnit\Tasks;

use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\DB;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Containers\ShippingUnit\Data\Repositories\ShippingConstRepository;
use Exception;

class SetDefaultShippingConstTask extends Task
{

    protected $repository;

    public function __construct(ShippingConstRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($constId, $shippingID)
    {
        try {
            $this->repository->where('shippingUnitID', $shippingID)->update([
                'is_default' => 0
            ]);
            $this->repository->find($constId)->update([
                'is_default' => 1 
            ]);
        }
        catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
