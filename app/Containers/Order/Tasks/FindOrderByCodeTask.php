<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-09-30 12:15:29
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-11-21 16:48:12
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\Tasks;

use App\Containers\Order\Data\Repositories\OrderRepository;
use App\Containers\Order\Models\Order;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindOrderByCodeTask extends Task
{
    protected $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(string $token): Order
    {
        try {
            return $this->repository->where('code', $token)->first();
        } catch (Exception $exception) {
            throw $exception;
            // throw new NotFoundException();
        }
    }
}
