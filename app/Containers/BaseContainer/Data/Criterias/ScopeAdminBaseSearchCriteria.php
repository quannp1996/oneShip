<?php

namespace App\Containers\BaseContainer\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Carbon\Carbon;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class ScopeAdminBaseSearchCriteria extends Criteria
{
    public $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function apply($model, PrettusRepositoryInterface $repository)
    {
        if (!empty($this->request->name)) {
            $model = $model->whereHas('desc', function ($query) {
                $query->where('name', 'LIKE', '%' . $this->request->name . '%');
            });
        }

        if (!empty($this->request->status)) {
            $model = $model->where('status', $this->request->status);
        } else {
            $model = $model->where('status', '>', 0);
        }

        if (!empty($this->request->time_from)) {
            $createdAtFormat = Carbon::createFromFormat('d/m/Y', $this->request->time_from)->format('Y-m-d 00:00:00');
            $model = $model->whereDate('created_at', '>=', $createdAtFormat);
        }

        if (!empty($this->request->time_to)) {
            $createdAtFormat = Carbon::createFromFormat('d/m/Y', $this->request->time_to)->format('Y-m-d 23:59:00');
            $model = $model->whereDate('created_at', '<=', $createdAtFormat);
        }

        return $model;
    }
}