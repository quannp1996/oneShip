<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-08-10 15:16:16
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-10-14 14:52:38
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\Data\Criterias;

use Apiato\Core\Foundation\Facades\FunctionLib;
use App\Containers\Order\Enums\OrderStatus;
use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class FilterOrdersCriteria extends Criteria
{
  private $filters;

  public function __construct($filters)
  {
    $this->filters = $filters;
  }

  public function apply($model, PrettusRepositoryInterface $repository)
  {
    $model = $this->detectOrderId($model);

    $model = $this->detectSyncId($model);

    $model = $this->detectPayment($model);

    $model = $this->detectDate($model);

    $model = $this->detectKeyword($model);

    $model = $this->detectStatus($model);

    $model = $this->detectUser($model);

    $model = $this->detectCustomer($model);

    $model = $this->isNeedReSync($model);

    $model = $this->syncOrNot($model);

    return $model;
  }

  private function detectStatus($model)
  {
    if (isset($this->filters['status']) && !empty($this->filters['status'])) {
      $model = $model->where('status', $this->filters['status']);
    }

    return $model;
  }

  private function detectDate($model)
  {
    if (isset($this->filters['from_date']) && !empty($this->filters['from_date'])) {
      $fromDate = FunctionLib::getCarbonFromVNDate($this->filters['from_date'])->toDateTimeString();
      $model = $model->whereDate('created_at', '>=', $fromDate);
    }

    if (isset($this->filters['to_date']) && !empty($this->filters['to_date'])) {
      $toDate = FunctionLib::getCarbonFromVNDate($this->filters['to_date'])->addDay(1)->toDateTimeString();
      $model = $model->whereDate('created_at', '<', $toDate);
    }
    return $model;
  }
  
  private function detectSyncId($model)
  {
    if (isset($this->filters['eshop_order_id']) && !empty($this->filters['eshop_order_id'])) {
      $model = $model->where('eshop_order_id', $this->filters['eshop_order_id']);
    }
    return $model;
  }
  private function detectKeyword($model)
  {
    if (isset($this->filters['keyword']) && !empty($this->filters['keyword'])) {
      $model = $model->where(function ($query) {
        $keyword = trim($this->filters['keyword']);
        $query->where('fullname', 'LIKE', '%' . $keyword . '%')
          ->orWhere('phone', 'LIKE', '%' . $keyword . '%')
          ->orWhere('email', 'LIKE', '%' . $keyword . '%');
      });
    }
    return $model;
  }

  private function detectPayment($model)
  {
    if (isset($this->filters['payment_status']) && !empty($this->filters['payment_status'])) {
      $model = $model->where('payment_status', $this->filters['payment_status']);
    }

    return $model;
  }

  private function detectUser($model)
  {
    if (!empty($this->filters['user_id'])) {
      $model = $model->whereHas('user', function ($query) {
        $query->where('id', $this->filters['user_id']);
      });
    }
    return $model;
  }

  private function detectCustomer($model)
  {
    if (isset($this->filters['customer_id']) && !empty($this->filters['customer_id'])) {
      $model = $model->where('customer_id', $this->filters['customer_id']);
    }
    return $model;
  }

  private function detectOrderId($model)
  {
    if (isset($this->filters['order_id']) && !empty($this->filters['order_id'])) {
      $model = $model->where(function ($query) {
        $query->where('id', $this->filters['order_id'])
          ->orWhere('code', $this->filters['order_id']);
      });
    }
    return $model;
  }

  private function isNeedReSync($model) {
    if ( !empty($this->filters['is_need_resync']) ) {
      $model = $model->where(function ($query) {
        $query->whereNotNull('eshop_order_id')
              ->where('is_need_resync', 1);
              // ->where('status', '!=', OrderStatus::CANCEL);
      });
    }
    return $model;
  }

  private function syncOrNot($model){
    if ( !empty($this->filters['eid_status']) ) {
      $model = $model->where(function ($query) {
        $query->whereNotNull('eshop_order_id');
      });
    }else{
      if(isset($this->filters['eid_status']) && $this->filters['eid_status'] != null){
        $model = $model->where(function ($query) {
          $query->whereNull('eshop_order_id');
        });
      }
    }
    return $model;
  }
}
