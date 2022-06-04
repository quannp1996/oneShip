<?php

namespace App\Containers\StaticPage\Tasks;

use App\Containers\StaticPage\Data\Repositories\StaticPageDescRepository;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;
use App\Ship\Parents\Tasks\Task;

/**
 * Class GetAllStaticPageDescTask.
 */
class GetAllStaticPageDescTask extends Task
{

    protected $repository;

    public function __construct(StaticPageDescRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     *
     * @return  mixed
     */
    public function run($id)
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria('static_page_id', $id));
        $wery = $this->repository->all()->keyBy('language_id')->toArray();

        return $wery;
    }
}
