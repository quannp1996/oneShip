<?php

namespace App\Containers\Order\Actions;

use App\Ship\Parents\Actions\Action;
use App\Containers\Order\Tasks\GetAllOrdersTask;

class GetAllOrdersAction extends Action
{
    protected $isSimplePagin = false;

    public function run(array $filters, array $with = [], array $column = ['*'], int $limit = 10, int $currentPage = 1)
    {
        return $this->remember(function () use ($filters, $with, $column, $limit, $currentPage) {
            $orders = app(GetAllOrdersTask::class)->ordersFilter($filters)
                ->with($with)
                ->selectFields($column)
                ->orderBy([['id', 'desc']]);

            if($this->isSimplePagin) {
                $orders->simplePagin();
            }

            return $orders->run($limit);
        },null,[],0,$this->skipCache);
    }

    public function simplePagin(): self
    {
        $this->isSimplePagin = true;
        return $this;
    }
}
