<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-25 20:00:43
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-11-21 16:48:02
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\Tasks;

use App\Containers\Order\Data\Repositories\OrderRepository;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindOrderByIdTask extends Task
{

    protected $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->find($id);
        }
        catch (Exception $exception) {
            throw $exception;
            // throw new NotFoundException();
        }
    }
}
