<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-30 12:15:29
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-11-21 16:48:08
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\Tasks;

use App\Containers\Order\Data\Repositories\OrderRepository;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindOrderByTokenTask extends Task
{
    protected $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(string $token)
    {
        try {
            return $this->repository->where('token_tracking', $token)->first();
        } catch (Exception $exception) {
            throw $exception;
            // throw new NotFoundException();
        }
    }
}
