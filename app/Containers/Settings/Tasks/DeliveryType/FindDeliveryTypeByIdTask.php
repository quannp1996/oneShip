<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-17 17:14:35
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-19 17:00:48
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\Tasks\DeliveryType;

use App\Containers\Settings\Data\Criterias\DeliveryType\WithAllDescriptionCriteria;
use App\Containers\Settings\Data\Criterias\DeliveryType\WithDescriptionCriteria;
use App\Containers\Settings\Data\Repositories\DeliveryTypeRepository;
use App\Ship\Parents\Tasks\Task;

class FindDeliveryTypeByIdTask extends Task
{

    protected $repository;

    public function __construct(DeliveryTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     *
     * @return  mixed
     */
    public function run($banner_id)
    {
        $data = $this->repository->find($banner_id);   
        return $data;
    }

    public function withDescription(): self
    {
        $this->repository->pushCriteria(new WithDescriptionCriteria($this->currentLang->language_id));
        return $this;
    }

    public function withAllDescription(): self
    {
        $this->repository->pushCriteria(new WithAllDescriptionCriteria());
        return $this;
    }
}