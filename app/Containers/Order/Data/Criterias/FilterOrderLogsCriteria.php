<?php

namespace App\Containers\Order\Data\Criterias;

use Apiato\Core\Foundation\Facades\FunctionLib;
use App\Containers\User\Models\User;
use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class FilterOrderLogsCriteria extends Criteria
{
  private $transporter;

  public function __construct($transporter)
  {
    $this->transporter = $transporter;
  }

  public function apply($model, PrettusRepositoryInterface $repository) {
    if (!empty($this->transporter->id)) {
      $model = $model->where('order_id', $this->transporter->id);
    }

    if (!empty($this->transporter->action_key)) {
      $model = $model->where('action_key', $this->transporter->action_key);
    }

    if (!empty($this->transporter->from_date)) {
      $fromDate = FunctionLib::getCarbonFromVNDate($this->transporter->from_date)->toDateTimeString();
      $model = $model->whereDate('created_at', '>=', $fromDate);
    }

    if (!empty($this->transporter->to_date)) {
      $toDate = FunctionLib::getCarbonFromVNDate($this->transporter->to_date)->addDay(1)->toDateTimeString();
      $model = $model->whereDate('created_at', '<', $toDate);
    }

    if (!empty($this->transporter->user_id)) {
      $model = $model->where(function ($query) {
        $query->where('object_id', $this->transporter->user_id)
              ->where('object_model', User::class);
      });
    }
    $model->orderBy('created_at', 'ASC');
    return $model;
  }
} // End class
