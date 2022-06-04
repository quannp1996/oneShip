<?php

namespace App\Containers\Customer\Data\Criterias;

use Apiato\Core\Foundation\Facades\FunctionLib;
use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class FilterLogCustomerReferralCriteria extends Criteria
{
  private $transporter;

  public function __construct($transporter)
  {
    $this->transporter = $transporter;
  }

  public function apply($model, PrettusRepositoryInterface $repository)
  {
    if ($this->transporter->type == 'nguoi_gioi_thieu') {

      $model = $model->where('customer_id', $this->transporter->id);

      if ($this->transporter->keyword) {
        $model =  $model->whereHas('customerReferral', function ($query) {
          $query->where('email', 'REGEXP', $this->transporter->keyword)
            ->orWhere('phone', 'REGEXP', $this->transporter->keyword)
            ->orWhere('fullname', 'REGEXP', $this->transporter->keyword);
        });
      }

      if ($this->transporter->customer_id) {
        $model =  $model->whereHas('customerReferral', function ($query) {
          $query->where('id', $this->transporter->customer_id);
        });
      }

    } else {

      $model = $model->where('ref_code', $this->transporter->ref_code);

      if ($this->transporter->keyword) {
        $model =  $model->whereHas('customerReferraled', function ($query) {
          $query->where('email', 'REGEXP', $this->transporter->keyword)
            ->orWhere('phone', 'REGEXP', $this->transporter->keyword)
            ->orWhere('fullname', 'REGEXP', $this->transporter->keyword);
        });
      }

      if ($this->transporter->customer_id) {
        $model =  $model->whereHas('customerReferraled', function ($query) {
          $query->where('id', $this->transporter->customer_id);
        });
      }
      
    }

    if ($this->transporter->created_at) {
      $createdAt = FunctionLib::getCarbonFromVNDate($this->transporter->created_at);
      $model = $model->whereDate('created_at', $createdAt);
    }

    $model = $model->orderBy('created_at', 'DESC');
    // dd($this->transporter->ref_code);
    return $model;
  }
} // End class
