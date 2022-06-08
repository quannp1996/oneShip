<?php

namespace App\Containers\DashBoard\Actions;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Arr;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Order\Enums\OrderStatus;
use App\Containers\Settings\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Collection;

class GetPurchasedAbilityStatisticAction extends Action
{
  public function run()
  {
    $endDate = Carbon::now();
    $startDate = Carbon::now()->subDays(14);
    $rangeDate = [$startDate, $endDate];
    $period = CarbonPeriod::create($startDate, $endDate->addDay());

    $purchasedAbility = Apiato::call('Order@GetPurchasedAbilityStatisticTask', [
      [],
      $rangeDate
    ]);

    $purchasedAbilityNew = Apiato::call('Order@GetPurchasedAbilityStatisticTask', [
      [
        ['status', '=', OrderStatus::NEW_ORDER],
      ],
      $rangeDate
    ]);

    $purchasedAbilityRefund = Apiato::call('Order@GetPurchasedAbilityStatisticTask', [
      [
        ['status', '=', OrderStatus::REFUND],
      ],
      $rangeDate
    ]);

    $purchasedAbilityCancel = Apiato::call('Order@GetPurchasedAbilityStatisticTask', [
      [
        ['status', '=', OrderStatus::CANCEL],
      ],
      $rangeDate
    ]);

    $purchasedAbilityPaid = Apiato::call('Order@GetPurchasedAbilityStatisticTask', [
      [
        ['payment_status', '=', PaymentStatus::PAID]
      ],
      $rangeDate,
      [
        'status' => [
          OrderStatus::CANCEL,
          OrderStatus::REFUND
        ]
      ]
    ]);

    $purchasedAbilityUnPaid = Apiato::call('Order@GetPurchasedAbilityStatisticTask', [
      [
        ['payment_status', '!=', PaymentStatus::PAID]
      ],

      $rangeDate,

      [
        'status' => [
          OrderStatus::CANCEL,
          OrderStatus::REFUND
        ]
      ]
    ]);

    $labels = $this->getRangeDateDetail($period);

    $dataSets = [
      [
        'label' => 'Tổng số ĐH',
        'data' => Arr::pluck($this->handleSortStatistic($period, $purchasedAbility), 'total_order'),
        'borderColor' => ['#4400d6']
      ],

      [
        'label' => 'Đơn mới',
        'data' => Arr::pluck($this->handleSortStatistic($period, $purchasedAbilityNew), 'total_order'),
        'borderColor' => ['#44c2bf']
      ],

      [
        'label' => 'Đơn hoàn',
        'data' => Arr::pluck($this->handleSortStatistic($period, $purchasedAbilityRefund), 'total_order'),
        'borderColor' => ['#fe44fe']
      ],

      [
        'label' => 'Đã thanh toán',
        'data' => Arr::pluck($this->handleSortStatistic($period, $purchasedAbilityPaid), 'total_order'),
        'borderColor' => ['#189602']
      ],

      [
        'label' => 'Chưa thanh toán',
        'data' => Arr::pluck($this->handleSortStatistic($period, $purchasedAbilityUnPaid), 'total_order'),
        'borderColor' => ['#eb1919']
      ],

      [
        'label' => 'Đơn hủy',
        'data' => Arr::pluck($this->handleSortStatistic($period, $purchasedAbilityCancel), 'total_order'),
        'borderColor' => ['#4c7093']
      ]
    ];

    return [
      'labels' => $labels,
      'datasets' => $dataSets
    ];
  }

  public function getRangeDateDetail($period): array {
    $labels = [];
    foreach ($period as $date) {
      $labels[] = $date->format('Y-m-d');
    }

    return $labels;
  }

  public function handleSortStatistic($period, Collection $ability) {
    $abilityArray = $ability->toArray();

    foreach ($period as $k => $date) {
      $dateFormat = $date->format('Y-m-d');
      if (!isset($abilityArray[$dateFormat])) {
        $abilityArray[$dateFormat] = [
          'total_order' => 0,
          'date' => $dateFormat,
          'index' => $k
        ];
      }else {
        $abilityArray[$dateFormat]['index'] = $k;
      }
    }

    $result = collect($abilityArray)->sortBy(function ($item) {
      return $item['index'];
    })->values()->all();

    return $result;
  }
} // End class
