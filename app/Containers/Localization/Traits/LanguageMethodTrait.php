<?php

namespace App\Containers\Localization\Traits;

trait LanguageMethodTrait
{
    public function getEnsignImg(): string {
      return sprintf('/admin/img/lang/%s', $this->image);
    }
} // End class
