<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-09-30 12:16:25
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-11-16 12:56:14
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\Actions;

use App\Containers\Localization\Models\Language;
use App\Ship\Parents\Actions\Action;
use App\Containers\Order\Tasks\FindOrderByTokenTask;

class FindOrderByTokenAction extends Action
{
  protected $externalWith = [];

  public function run(string $token, array $with = [], array $column = ['*'])
  {
    $this->externalWith = array_merge($this->externalWith,[
      'orderItems' => function ($q) {
        // $q->where('variant_parent_id',0);
        $q->orderBy('id','asc');
      }
    ]);
    
    $order = app(FindOrderByTokenTask::class)->externalWith($this->externalWith)->with($with)->selectFields($column)->run($token);

    return $order;
  }

  public function descProduct(?Language $currentLang): self
  {
    $languageId = $currentLang ? $currentLang->language_id : 1;
    $this->externalWith = array_merge($this->externalWith, [
      'orderItems.product.desc' => function ($query) use ($languageId) {
        $query->select('id', 'product_id', 'name', 'slug');
        $query->whereHas('language', function ($q) use ($languageId) {
          $q->where('language_id', $languageId);
        });
      }
    ]);
    return $this;
  }

  public function orderLocation(): self
  {
    $this->externalWith = array_merge($this->externalWith, [
      'province',
      'district',
      'ward'
    ]);
    return $this;
  }
}
