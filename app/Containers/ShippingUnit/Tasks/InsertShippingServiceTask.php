<?php

namespace App\Containers\ShippingUnit\Tasks;

use Exception;
use App\Ship\Parents\Tasks\Task;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Containers\ShippingUnit\Data\Repositories\ShippingServicesRepository;

class InsertShippingServiceTask extends Task
{

    protected $repository;

    public function __construct(ShippingServicesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data, $shippingID)
    {
        try {
            $this->repository->where('shippingID', $shippingID)->delete();
            array_map(function($item) {
                $this->repository->create($item);
            }, $data);
            return true;
        }
        catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}
