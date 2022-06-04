<?php

namespace App\Containers\DashBoard\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use Apiato\Core\Foundation\FunctionLib;

class GetProductSingleStatisticAction extends Action
{
    public function run(int $productId=0)
    {
      $productRevenue = Apiato::call('Product@GetRevenueOfProductTask', [$productId]);
      return [
        'labels' => $productRevenue->pluck('date'),
        'datasets' => [
          [
            'label' => 'Doanh số',
            'data' => $productRevenue->pluck('total_revenue'),
          ]
        ],
        'revenue_txt' => $productRevenue->pluck('total_revenue')->map(function ($item) {
          return FunctionLib::priceFormat($item);
        })
      ];
      return $productRevenue;
    }
}
