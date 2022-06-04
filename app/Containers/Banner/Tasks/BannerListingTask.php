<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-10 15:16:15
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-07 20:44:45
 * @ Description: Happy Coding!
 */

namespace App\Containers\Banner\Tasks;

use App\Containers\Banner\Data\Criterias\AdminFilterCriteria;
use App\Containers\Banner\Data\Criterias\HasNameCriteria;
use App\Containers\Banner\Data\Criterias\OrderByCreatedCriteria;
use App\Containers\Banner\Data\Criterias\OrderBySortCriteria;
use App\Containers\Banner\Data\Criterias\WithAllDescriptionCriteria;
use App\Containers\Banner\Data\Criterias\WithDescriptionCriteria;
use App\Containers\Banner\Data\Repositories\BannerRepository;
use App\Ship\Criterias\Eloquent\OrderByFieldCriteria;
use App\Ship\Criterias\Eloquent\OrderByFieldsCriteria;
use App\Ship\Parents\Tasks\Task;

class BannerListingTask extends Task
{
    protected $repository;

    public function __construct(BannerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($limit = 20)
    {
        return $this->repository->with(['desc'])->paginate($limit);
    }

    public function adminFilter($request): self
    {
        $this->repository->pushCriteria(new AdminFilterCriteria($request));
        return $this;
    }

    public function hasName($name): self
    {
        $this->repository->pushCriteria(new HasNameCriteria($name));
        return $this;
    }

    public function withDescription($language_id): self
    {
        $this->repository->pushCriteria(new WithDescriptionCriteria($language_id));
        return $this;
    }

    public function withAllDescription(): self
    {
        $this->repository->pushCriteria(new WithAllDescriptionCriteria());
        return $this;
    }

    public function ordereByCreated(): self
    {
        $this->repository->pushCriteria(new OrderByFieldsCriteria([
            ['created_at','desc'],
            ['sort_order','asc'],
            ['position','desc']
        ]));
        return $this;
    }
}
