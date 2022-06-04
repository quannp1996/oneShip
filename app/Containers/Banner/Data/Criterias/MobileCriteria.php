<?php

namespace App\Containers\Banner\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class MobileCriteria.
 *
 *
 */
class MobileCriteria extends Criteria
{

    protected $isMobile;

    public function __construct(bool $isMobile)
    {
        $this->isMobile = $isMobile;
    }

    /**
     * @param                                                   $model
     * @param \Prettus\Repository\Contracts\RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->where('is_mobile', $this->isMobile ? 1 : 0);
    }
}
