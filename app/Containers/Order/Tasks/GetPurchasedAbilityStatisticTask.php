<?php

namespace App\Containers\Order\Tasks;

use App\Containers\Order\Data\Repositories\OrderRepository;
use App\Ship\Parents\Tasks\Task;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class GetPurchasedAbilityStatisticTask extends Task
{

    protected $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $where=[], array $rangeDate=[], array $whereNotIn=[])
    {
        // \DB::enableQueryLog();
        $result = $this->repository
                                   ->whereDate('created_at', '>=', Arr::first($rangeDate))
                                   ->whereDate('created_at', '<=', Arr::last($rangeDate))
                                   ->where($where);
        if (!empty($whereNotIn)) {
          $result = $result->whereNotIn(key($whereNotIn), Arr::last($whereNotIn));
        }
        $result = $result->selectRaw("COUNT(id) as total_order, DATE(created_at) as date")
                        ->groupByRaw('date')
                        ->get()
                        ->keyBy('date');
        // dump(\DB::getQueryLog());
        return $result;
    }
}
