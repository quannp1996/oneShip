<?php

namespace App\Containers\Order\Tasks;

use App\Containers\Order\Data\Repositories\OrderLogRepository;
use App\Ship\Parents\Tasks\Task;

class OrderAddLogTask extends Task
{

    protected $repository;

    public function __construct(OrderLogRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, $action = 'add',$note='',$guard = 'admin')
    {
        $user = \Auth::guard($guard)->user();
        //record new log
        $log['order_id'] = $id;
        $log['ip'] = \Request::ip();
        $log['action_key'] = $action;
        $log['username'] = (isset($user->user_name) ? $user->user_name : 'system');
        $log['created'] = time();
        $log['note'] = $note;

        $result = $this->repository->create($log);
        
        return $result->id;
    }
}
