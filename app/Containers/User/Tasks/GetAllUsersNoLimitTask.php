<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Criterias\AdminFilterCriteria;
use App\Containers\User\Data\Criterias\WithRoleCriteria;
use App\Containers\User\Data\Repositories\UserRepository;
use App\Ship\Criterias\Eloquent\OrderByCreationDateDescendingCriteria;
use App\Ship\Parents\Tasks\Task;

/**
 * Class GetAllUsersTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllUsersNoLimitTask extends GetAllUsersTask
{

    public function run($limit = 20){

        return $this->repository->get();
    }

    public function adminFilterSpecical(array $filter){

        return $this->repository = $this->repository->where($filter);
    }

    public function withColumn(array $columns = ['*']){

        $this->repository->select($columns);
    }
}
