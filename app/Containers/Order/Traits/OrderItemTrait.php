<?php

namespace App\Containers\Order\Traits;
use Apiato\Core\Foundation\FunctionLib;

trait OrderItemTrait
{
  public function getPriceCurrencyAttribute() {
    return FunctionLib::priceFormat($this->price);
  }

  public function getTotalPriceProductCurrencyAttribute() {
    return FunctionLib::priceFormat($this->price * $this->quantity);
  }
} // End class

