<?php

namespace App\Containers\DashBoard\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class GetDiscountCodeStatisticAction extends Action
{
  public function run()
  {
    $codes = Apiato::call('Discount@GetDiscountCodeStatisticByTypeTask');
    return [
      'labels' => $codes->pluck('discount_type')->map(function ($item) {
        return config('discount-container.discount_type.'.$item);
      }),
      'datasets' => [
        [
          'label' => 'Lượt sử dụng',
          'data' => $codes->pluck('total_use'),
          'backgroundColor' => ['#00927c', '#ffae19', '#0099ff']
        ]
      ],
    ];
  }
} // End class
