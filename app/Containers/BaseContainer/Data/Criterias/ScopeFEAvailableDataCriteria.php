<?php

namespace App\Containers\BaseContainer\Data\Criterias;

use App\Ship\core\Foundation\BladeHelper;
use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class ScopeFEAvailableDataCriteria extends Criteria
{
    private $languageId;
    private $selectFieldsDesc;

    public function __construct($languageId, $selectFieldsDesc)
    {
        $this->languageId = $languageId;
        $this->selectFieldsDesc = $selectFieldsDesc;
    }

    public function apply($model, PrettusRepositoryInterface $repository)
    {
        $model->where('status', '=', BladeHelper::HIEN_THI);
        $model->orderBy('sort_order', 'ASC');
        $model->orderBy('id', 'DESC');

        $model->mustHaveDesc($this->languageId);

        $model->with(['desc' => function ($query) {
            $query->select($this->selectFieldsDesc);
            $query->activeLang($this->languageId);
        }]);

        return $model;
    }
}