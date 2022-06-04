<?php

namespace App\Containers\Customer\Data\Criterias;

use Apiato\Core\Foundation\Facades\FunctionLib;
use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class FilterCustomerCriteria extends Criteria
{
  private $transporter;

  public function __construct($transporter)
  {
    $this->transporter = $transporter;
  }

  public function apply($model, PrettusRepositoryInterface $repository) {
    if ($this->transporter->id) {
      $model = $model->where('id', $this->transporter->id);
    }

    if ($this->transporter->keyword) {
      $model =  $model->where(function ($query) {
        $query->where('email', 'REGEXP', $this->transporter->keyword)
              ->orWhere('phone', 'REGEXP', $this->transporter->keyword)
              ->orWhere('fullname', 'REGEXP', $this->transporter->keyword);
      });
    }

    if ($this->transporter->address) {
      $model =  $model->whereHas('mainAddress', function($query) {
        $query->where('address_book.address', 'LIKE', '%'.$this->transporter->address.'%');
      });
    }

    if ($this->transporter->status) {
      $model =  $model->where('status', $this->transporter->status);
    }

    if ($this->transporter->created_at) {
      $createdAt = FunctionLib::getCarbonFromVNDate($this->transporter->created_at);
      $model = $model->whereDate('created_at', $createdAt);
    }
    
    if ($this->transporter->started_at) {
      $createdAt = FunctionLib::getCarbonFromVNDate($this->transporter->started_at);
      $model = $model->whereDate('created_at', $createdAt);
    }
    if ($this->transporter->roles_ids) {
      $model = $model->whereHas('roles', function ($q) {
        $q->whereIn('id', $this->transporter->roles_ids);
      });
    }

    if ($this->transporter->group_id) {
      $model = $model->whereHas('groups', function ($query) {
        $query->where('customer_group.id', $this->transporter->group_id);
      });
    }

    if (isset($this->transporter->is_contractor)) {
      $model = $model->where('is_contractor', $this->transporter->is_contractor);
    }

    if ($this->transporter->sort) {
      $sort = $this->transporter->sort;

      if (isset($sort->id)) {
        $model = $model->orderBy('id', $sort->id == 0 ? 'DESC' : 'ASC');
      }

      if (isset($sort->fullname)) {
        $model = $model->orderBy('fullname', $sort->fullname == 0 ? 'DESC' : 'ASC');
      }

      if (isset($sort->email)) {
        $model = $model->orderBy('email', $sort->email == 0 ? 'DESC' : 'ASC');
      }

      if (isset($sort->phone)) {
        $model = $model->orderBy('phone', $sort->phone == 0 ? 'DESC' : 'ASC');
      }

      if (isset($sort->created_at)) {
        // $model = $model->orderBy('created_at', $sort->created_at == 0 ? 'DESC' : 'ASC');
        $model = $sort->created_at == 1 ? $model->orderByRaw('DATE(created_at) desc') : $model->orderByRaw('DATE(created_at) asc');
      }
    }else {
      $model = $model->orderBy('id', 'DESC');
    }

    return $model;
  }
} // End class
