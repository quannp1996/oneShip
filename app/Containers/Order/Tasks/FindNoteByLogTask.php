<?php


namespace App\Containers\Order\Tasks;

use App\Containers\Order\Data\Repositories\OrderNoteRepository;
use App\Ship\Criterias\Eloquent\SelectFieldsCriteria;
use App\Ship\Criterias\Eloquent\WithCriteria;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindNoteByLogTask extends Task
{

    protected $repository;

    public function __construct(OrderNoteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($order_id, $action_key)
    {
        try {
            return $this->repository->where('order_id', $order_id)->where('order_action', $action_key)->take(1);
        } catch (Exception $exception) {
            throw $exception;
            // throw new NotFoundException();
        }
    }
}
