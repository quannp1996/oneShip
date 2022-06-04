<?php

namespace App\Containers\Banner\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class WithDescriptionCriteria.
 *
 *
 */
class WithDescriptionCriteria extends Criteria
{

    protected $language_id;

    public function __construct($language_id)
    {
        $this->language_id = $language_id;
    }

    /**
     * @param                                                   $model
     * @param \Prettus\Repository\Contracts\RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        $language_id = $this->language_id;

        return $model->with(['desc' => function ($query) use ($language_id){
            $query->select('id', 'banner_id', 'language_id', 'name', 'short_description', 'image');
            $query->activeLang($language_id);
        }]);
    }
}
