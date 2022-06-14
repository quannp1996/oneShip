<?php

namespace App\Containers\Location\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface;

class FilterCityCriteria extends Criteria
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
        if (!empty($this->queryParams['district_id'])) {
            $model = $model->where('district_id', $this->queryParams['district_id']);
        }
        return $model;
    }
}
