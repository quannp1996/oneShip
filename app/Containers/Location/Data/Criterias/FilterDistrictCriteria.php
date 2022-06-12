<?php

namespace App\Containers\Location\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface;

class FilterDistrictCriteria extends Criteria
{
    private $queryParams;

    public function __construct(array $queryParams=[])
    {
        $this->queryParams = $queryParams;
    }
    
    public function apply($model, RepositoryInterface $repository)
    {
        if (!empty($this->queryParams['name'])) {
            $model = $model->where('name', 'LIKE', '%'. $this->queryParams['name'] .'%');
        }
        if (!empty($this->queryParams['province_id'])) {
            $model = $model->where('province_id', $this->queryParams['province_id']);
        }
        return $model;
    }
}
