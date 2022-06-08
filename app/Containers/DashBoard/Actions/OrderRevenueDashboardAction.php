<?php

namespace App\Containers\DashBoard\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class OrderRevenueDashboardAction extends Action
{
  public function run()
  {
    $dashboards = Apiato::call('Order@OrderRevenueDashboardTask');
    return [
      'labels' => $dashboards->pluck('date'),
      'datasets' => [
        [
          'label' => 'Doanh số',
          'data' => $dashboards->pluck('total_price'),
        ]
      ],
      'revenue_txt' => $dashboards->pluck('total_price_currency')
    ];
  }
} // End class
