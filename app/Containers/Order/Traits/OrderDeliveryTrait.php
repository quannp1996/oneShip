<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-09-22 00:50:39
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-09-22 00:51:33
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\Traits;

trait OrderDeliveryTrait
{
  public function getDeliveryText(): string {
    return !empty($this->deliveryType) ? $this->deliveryType->desc->name : '';
  }
}

