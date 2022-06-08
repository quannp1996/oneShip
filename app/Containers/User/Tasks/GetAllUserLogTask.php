<?php

namespace App\Containers\User\Tasks;

use Apiato\Core\Foundation\Facades\FunctionLib;
use App\Containers\User\Data\Repositories\UserLogRepository;
use App\Ship\Criterias\Eloquent\ThisOperationThatCriteria;
use App\Ship\Parents\Tasks\Task;
use Carbon\Carbon;

/**
 * Class GetAllUserLogTask.
 */
class GetAllUserLogTask extends Task
{

    protected $repository;

    public function __construct(UserLogRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     *
     * @return  mixed
     */
    public function run($filters = [], $orderBy = ['created_at' => 'desc','id' => 'desc'], $limit = 20, $external_data = ['with_relationship' => ['user']])
    {
        if(!empty($external_data) && !empty($external_data['with_relationship'])){
            $this->repository->with(array_merge($external_data['with_relationship']));
        }

        if (isset($filters->user_id) && $filters->user_id > 0){
            $this->repository->pushCriteria(new ThisOperationThatCriteria('user_id', $filters->user_id, '='));
        }

        if (isset($filters->object_id) && $filters->object_id > 0){
            $this->repository->pushCriteria(new ThisOperationThatCriteria('object_id', $filters->object_id, '='));
        }

        if (!empty($filters->ip)){
            $this->repository->pushCriteria(new ThisOperationThatCriteria('ip', $filters->ip, '='));
        }

        if (!empty($filters->action_name)){
            $this->repository->pushCriteria(new ThisOperationThatCriteria('note', "%{$filters->action_name}%", 'like'));
        }

        if (isset($filters->time_from) && !empty($filters->time_from) && $filters->time_from != '') {
            $this->repository->pushCriteria(new ThisOperationThatCriteria('created_at', Carbon::createFromTimestamp(FunctionLib::getTimestampFromVNDate($filters->time_from)), '>='));
        }
        if (isset($filters->time_to) && !empty($filters->time_to) && $filters->time_to != '') {
            $this->repository->pushCriteria(new ThisOperationThatCriteria('created_at', Carbon::createFromTimestamp(FunctionLib::getTimestampFromVNDate($filters->time_to, true)), '<='));
        }

        foreach ($orderBy as $column => $direction) {
            $this->repository->orderBy($column, $direction);
        }
        // \DB::enableQueryLog();
        return $this->repository->paginate($limit);
        // dd(\DB::getQueryLog());
    }
}
