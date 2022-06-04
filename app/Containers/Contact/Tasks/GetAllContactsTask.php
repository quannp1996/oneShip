<?php

namespace App\Containers\Contact\Tasks;

use Apiato\Core\Traits\FilterFields;
use App\Containers\Contact\Data\Repositories\ContactRepository;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;
use App\Ship\Criterias\Eloquent\ThisOperationThatCriteria;
use App\Ship\Parents\Tasks\Task;

class GetAllContactsTask extends Task
{
    use FilterFields;
    protected $repository;
    protected $equalFields = [];
    public function __construct(ContactRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->with('fields')->orderBy('created_at', 'desc')->paginate();
    }

    public function filter(array $condition = [])
    {
        parent::filter($condition);
        if(!empty($condition['shop_name'])) $this->repository->pushCriteria(new ThisOperationThatCriteria('shop_name', '%'.$condition['shop_name'].'%', 'LIKE'));
        if(!empty($condition['phone'])) $this->repository->pushCriteria(new ThisEqualThatCriteria('phone', $condition['phone']));
        if(!empty($condition['email'])) $this->repository->pushCriteria(new ThisEqualThatCriteria('email', $condition['email']));
        return $this;
    }
}
