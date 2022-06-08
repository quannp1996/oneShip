<?php

namespace App\Containers\Order\Traits;
use Apiato\Core\Foundation\FunctionLib;

trait PriceTrait
{
  public function getTotalPriceCurrencyAttribute() {
    return FunctionLib::priceFormat($this->total_price);
  }

  public function getFeeShipCurrencyAttribute() {
    return FunctionLib::priceFormat($this->fee_shipping);
  }

  public function getPriceCurrencyAttribute() {
    return FunctionLib::priceFormat((float)$this->price);
  }

  public function getTotalDiscountMoney() {
    $money = $this->total_discount_value;
    // $money = $this->total_gross - $this->total_price;
    if ($money <= 0) {
      $money = 0;
    }
    return $money;
  }

  public function getOnlyPromotionMoney() {
    $totalDiscountMoneyExceptCoupon = $this->getTotalDiscountMoney();
    $promotionMoney = $totalDiscountMoneyExceptCoupon - $this->coupon_value ;
    if ( !empty($this->point_value) ) {
      $promotionMoney = $promotionMoney - $this->point_value * $this->point_rate;
    }
    if ($promotionMoney <= 0) {
      $promotionMoney = 0;
    }
    return $promotionMoney;
  }
} // End class

