<?php

namespace App\Containers\Order\Tasks;

use App\Containers\Order\Data\Repositories\OrderNoteRepository;
use App\Ship\Criterias\Eloquent\WithCriteria;
use App\Ship\Parents\Tasks\Task;

class GetAllOrderNotesTask extends Task
{

    protected $repository;

    public function __construct(OrderNoteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $where = [])
    {
        return $this->repository->findWhere($where);
    }

    public function with(array $with = []): self
    {
        $this->repository->pushCriteria(new WithCriteria($with));
        return $this;
    }
}
