<?php

namespace App\Containers\StaticPage\Tasks;

use Apiato\Core\Foundation\Facades\FunctionLib;
use App\Containers\StaticPage\Data\Repositories\StaticPageRepository;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;
use App\Ship\Criterias\Eloquent\ThisOperationThatCriteria;
use App\Ship\Parents\Tasks\Task;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ListStaticPageTask.
 */
class ListStaticPageTask extends Task
{
    protected $repository;

    public function __construct(StaticPageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($filters = [], $orderBy = ['created_at' => 'desc', 'id' => 'desc'], $limit = 20, $defaultLanguage = null, $external_data = [])
    {
        $language_id = $defaultLanguage ? $defaultLanguage->language_id : 1;
        // if (isset($filters['id']) && $filters['id'] != '') {
        //     $this->repository->pushCriteria(new ThisEqualThatCriteria('id', $filters['id']));
        // } else {
        //     if (isset($filters['status']) && $filters['status'] != '') {
        //         $this->repository->pushCriteria(new ThisEqualThatCriteria('status', $filters['status']));
        //     } else {
        //         $this->repository->pushCriteria(new ThisOperationThatCriteria('status', 0, '>'));
        //     }
        //     if (isset($filters['time_from']) && !empty($filters['time_from']) && $filters['time_from'] != '') {
        //         $this->repository->pushCriteria(new ThisOperationThatCriteria('created_at', Carbon::createFromTimestamp(FunctionLib::getTimestampFromVNDate($filters['time_from'])), '>='));
        //     }
        //     if (isset($filters['time_to']) && !empty($filters['time_to']) && $filters['time_to'] != '') {
        //         $this->repository->pushCriteria(new ThisOperationThatCriteria('created_at', Carbon::createFromTimestamp(FunctionLib::getTimestampFromVNDate($filters['time_to'], true)), '<='));
        //     }
        // }
        $this->repository->with(['desc']);

        // if (isset($filters['name']) && !empty($filters['name'])) {
        //     $this->repository->whereHas('desc', function (Builder $query) use ($filters) {
        //         $query->where('name', 'like', '%' . $filters['name'] . '%');
        //     });
        // }

        // if (!empty($filters['position'])) {
        //     $this->repository->where('position', 'like', '%' . $filters['position'] . '%');
        // }

        // foreach ($orderBy as $column => $direction) {
        //     $this->repository->orderBy($column, $direction);
        // }
        return $this->repository->paginate($limit);
    }
}
