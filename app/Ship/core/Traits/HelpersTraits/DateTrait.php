<?php

namespace App\Ship\core\Traits\HelpersTraits;

use Apiato\Core\Foundation\FunctionLib;

trait DateTrait
{
  public function formatDate($value)
  {
    return FunctionLib::dateFormat($value, 'd/m/Y H:i');
  }
  public function getCreatedAtAttribute($value)
  {
    return FunctionLib::dateFormat($value, 'd/m/Y H:i');
  }

  public function getUpdatedAtAttribute($value)
  {
    return FunctionLib::dateFormat($value, 'd/m/Y H:i');
  }
} // End class
