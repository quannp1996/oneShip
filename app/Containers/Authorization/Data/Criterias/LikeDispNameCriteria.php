<?php

namespace App\Containers\Authorization\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class LikeDispNameCriteria.
 *
 */
class LikeDispNameCriteria extends Criteria
{
    private $disp_name;

    public function __construct($disp_name)
    {
        $this->disp_name = $disp_name;
    }

    /**
     * @param                                                   $model
     * @param \Prettus\Repository\Contracts\RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->where('display_name','LIKE', '%'.$this->disp_name.'%');
    }
}
