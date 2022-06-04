<?php

namespace App\Containers\Field\Tasks;

use App\Containers\Field\Data\Repositories\FieldRepository;
use App\Ship\Parents\Tasks\Task;

class GetAllFieldsTask extends Task
{

    protected $repository;

    public $equalFields = ['status', 'is_required'];

    public function __construct(FieldRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->paginate();
    }

    public function filter(array $condition = [])
    {
        parent::filter($condition);
        return $this;
    }
}
