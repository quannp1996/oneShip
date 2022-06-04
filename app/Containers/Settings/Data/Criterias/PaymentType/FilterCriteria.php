<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-17 17:46:14
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-20 01:21:02
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\Data\Criterias\PaymentType;

use Apiato\Core\Foundation\Facades\FunctionLib;
use Carbon\Carbon;
use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class FilterCriteria extends Criteria
{
    public $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function apply($model, PrettusRepositoryInterface $repository)
    {
        if (isset($this->data['id']) && !empty($this->data['id']) && $this->data['id'] > 0) {
            $model = $model->where('id', $this->data['id']);
        } else {
            if (isset($this->data['status'])) {
                $model = $model->where('status', $this->data['status']);
            } else {
                $model = $model->where('status', '>', 0);
            }
            if (isset($this->data['time_from']) && !empty($this->data['time_from'])) {
                $timeFrom = Carbon::createFromTimestamp(FunctionLib::getTimestampFromVNDate($this->data['time_from']));
                $model = $model->whereDate('created_at', '>=', $timeFrom);
            }
            if (isset($this->data['time_to']) && !empty($this->data['time_to'])) {
                $timeTo = Carbon::createFromTimestamp(FunctionLib::getTimestampFromVNDate($this->data['time_to'], true));
                $model = $model->whereDate('created_at', '<=', $timeTo);
            }
        }
        return $model;
    }
}
