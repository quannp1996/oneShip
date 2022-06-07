<?php

namespace App\Containers\Customer\Tasks;

use App\Containers\Customer\Data\Repositories\CustomerRepository;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\DB;
use Exception;

class CountOwnersByStatusTask extends Task
{

    protected $repository;

    public function __construct(CustomerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        try {
            return $this->repository->select(DB::raw('count(*) as count, status'))->where('deleted_at', NULL)->where('is_contractor', 0)
            ->groupBy('status')->get()->keyBy('status');
        }
        catch (Exception $exception) {
            throw $exception;
        }
    }
}
