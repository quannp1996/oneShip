<?php

namespace App\Containers\DashBoard\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use Apiato\Core\Foundation\FunctionLib;
use App\Containers\Order\Enums\OrderStatus;
use App\Containers\Settings\Enums\PaymentStatus;

class OrderStatisticDashboardAction extends Action
{
  public function run()
  {
    $statistic = [];
    $whereString = sprintf(
      ' payment_status = %s AND status NOT IN(%s, %s) ',
      PaymentStatus::PAID,
      OrderStatus::CANCEL,
      OrderStatus::REFUND
    );

    $statistic['total_order_paid'] = Apiato::call('Order@GetNumberOfOrderByStatusTask', [$whereString]);

    $whereStringUnPaid = sprintf(
      '  payment_status != %s AND status NOT IN(%s, %s) ',
      PaymentStatus::PAID,
      OrderStatus::CANCEL,
      OrderStatus::REFUND
    );

    $statistic['total_order_unpaid'] = Apiato::call('Order@GetNumberOfOrderByStatusTask', [$whereStringUnPaid]);


    $statistic['total_order_revenue_success'] = Apiato::call('Order@GetOrderRevenueTask', [$whereString]);
    $statistic['total_order_revenue_success_txt'] = FunctionLib::priceFormat($statistic['total_order_revenue_success']);

    $statistic['total_order_revenue_expect'] = Apiato::call('Order@GetOrderRevenueTask', [$whereStringUnPaid]);
    $statistic['total_order_revenue_expect_txt'] = FunctionLib::priceFormat($statistic['total_order_revenue_expect']);
    $statistic['total_customer_active'] = Apiato::call('Customer@GetNumberOfCustomerByStatusTask', [
      [
        ['active', '=', 1]
      ]
    ]);
    $statistic['total_customer_unactive'] = Apiato::call('Customer@GetNumberOfCustomerByStatusTask', [
      [
        ['active', '!=', 1]
      ]
    ]);

    $statistic['total_new_register'] = Apiato::call('Customer@GetNumberOfCustomerNewRegisterTask', []);
    return $statistic;
  }
}
