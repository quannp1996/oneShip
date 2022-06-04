<?php

namespace App\Containers\Banner\Tasks;

use App\Containers\Banner\Data\Repositories\BannerDescRepository;
use App\Containers\Banner\Data\Repositories\BannerRepository;
use App\Containers\News\Data\Repositories\NewsDescRepository;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;
use App\Ship\Parents\Tasks\Task;

/**
 * Class GetAllBannerDescTask.
 */
class GetAllBannerDescTask extends Task
{

    protected $repository;

    public function __construct(BannerDescRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     *
     * @return  mixed
     */
    public function run($banner_id)
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria('banner_id', $banner_id));
        $wery = $this->repository->all()->keyBy('language_id')->toArray();
        return $wery;
    }
}
