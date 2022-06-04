<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-30 12:16:25
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-10 17:42:25
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\Actions;

use App\Containers\Localization\Models\Language;
use App\Containers\Order\Tasks\FindOrderByCodeTask;
use App\Ship\Parents\Actions\Action;

class FindOrderByCodeAction extends Action
{
  protected $externalWith = [];

  public function run(string $code, array $with = [], array $column = ['*'])
  {
    $order = app(FindOrderByCodeTask::class)->externalWith($this->externalWith)->with($with)->selectFields($column)->run($code);

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
