<?php

namespace App\Containers\Banner\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class HasNameCriteria.
 *
 *
 */
class HasNameCriteria extends Criteria
{

    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @param                                                   $model
     * @param \Prettus\Repository\Contracts\RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        $name = $this->name;

        return $model->whereHas('desc', function ($query) use ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        });
    }
}
