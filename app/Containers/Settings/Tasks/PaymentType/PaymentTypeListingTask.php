<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-17 17:14:35
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-14 11:22:18
 * @ Description: Happy Coding!
 */


namespace App\Containers\Settings\Tasks\PaymentType;

use App\Containers\Banner\Data\Criterias\OrderBySortCriteria;
use App\Containers\Settings\Data\Criterias\PaymentType\FilterCriteria;
use App\Containers\Settings\Data\Criterias\PaymentType\HasNameCriteria;
use App\Containers\Settings\Data\Criterias\PaymentType\OrderByCreatedCriteria;
use App\Containers\Settings\Data\Criterias\PaymentType\WithAllDescriptionCriteria;
use App\Containers\Settings\Data\Criterias\PaymentType\WithDescriptionCriteria;
use App\Containers\Settings\Data\Repositories\PaymentTypeRepository;
use App\Ship\Parents\Tasks\Task;

class PaymentTypeListingTask extends Task
{

    protected $repository;

    public function __construct(PaymentTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(bool $skipPagin = false,int $limit = 20)
    {
        return $skipPagin ? $this->repository->where('status', '>' , 0)->take($limit)->get() : $this->repository->where('status', '>' , 0)->paginate($limit);
    }

    public function filters(array $data): self
    {
        if(!empty($data)) {
            $this->repository->pushCriteria(new FilterCriteria($data));
        }
        return $this;
    }

    public function hasName(string $name): self
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
        $this->repository->pushCriteria(new OrderByCreatedCriteria());
        return $this;
    }

    public function ordereBySort(): self
    {
        $this->repository->pushCriteria(new OrderBySortCriteria());
        return $this;
    }
}
