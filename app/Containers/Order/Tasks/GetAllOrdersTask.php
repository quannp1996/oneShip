<?php

namespace App\Containers\Order\Tasks;

use App\Containers\Order\Data\Criterias\FilterOrdersCriteria;
use App\Containers\Order\Data\Repositories\OrderRepository;
use App\Ship\Criterias\Eloquent\OrderByFieldsCriteria;
use App\Ship\Parents\Tasks\Task;

class GetAllOrdersTask extends Task
{

  protected $isSimplePagin = false;
  protected $repository;

  public function __construct(OrderRepository $repository)
  {
    $this->repository = $repository;
  }

  public function run($limit = 20)
  {
    return $this->isSimplePagin ? $this->repository->simplePaginate($limit) : $this->repository->paginate($limit);
  }

  public function simplePagin(): self
  {
    $this->isSimplePagin = true;
    return $this;
  }

  public function ordersFilter(array $filters): self
  {
    $this->repository->pushCriteria(new FilterOrdersCriteria($filters));
    return $this;
  }

  public function orderBy(array $orderBy): self
  {
    $this->repository->pushCriteria(new OrderByFieldsCriteria($orderBy));
    return $this;
  }
} // End class
