<?php

namespace App\Containers\Customer\Data\Criterias;

use Apiato\Core\Foundation\Facades\FunctionLib;
use App\Ship\Parents\Criterias\Criteria;
use App\Containers\Order\Enums\OrderStatus;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class FilterLogOrderReferralCriteria extends Criteria
{
  private $transporter;

  public function __construct($transporter)
  {
    $this->transporter = $transporter;
  }

  public function apply($model, PrettusRepositoryInterface $repository)
  {
    if ($this->transporter->id) {
      $model = $model->where('customer_id', $this->transporter->id);
    }
    $model =  $model->whereHas('order', function ($query) {
      $query->where('status',OrderStatus::DONE);
    });
    if ($this->transporter->keyword) {
      $model =  $model->whereHas('order', function ($query) {
        $query->where('email', 'REGEXP', $this->transporter->keyword)
          ->orWhere('phone', 'REGEXP', $this->transporter->keyword)
          ->orWhere('fullname', 'REGEXP', $this->transporter->keyword);
      });
    }
    if ($this->transporter->code) {
      $model =  $model->whereHas('order', function ($query) {
        $query->where('code', $this->transporter->code);
       
      });
    }

    if ($this->transporter->created_at) {
      $createdAt = FunctionLib::getCarbonFromVNDate($this->transporter->created_at);
      $model = $model->whereDate('created_at', $createdAt);
    }
    $model =$model->where('point','>=',1);
    $model = $model->orderBy('created_at', 'DESC');

    return $model;
  }
} // End class
