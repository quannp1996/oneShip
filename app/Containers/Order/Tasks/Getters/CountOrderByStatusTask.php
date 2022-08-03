<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-11-21 19:55:49
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-11-21 20:07:26
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\Tasks\Getters;

use App\Containers\Order\Data\Repositories\OrderRepository;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\DB;

class CountOrderByStatusTask extends Task
{
    protected $repository;
    protected $customerId, $couponCode;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $status)
    {
        $query = DB::table('orders')->selectRaw('COUNT(*) AS number, status');
        if(!empty($status)) $query->whereIn('status', $status);
        return $query->groupBy('status')->get();
    }
}
