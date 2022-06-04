<?php

namespace App\Ship\core\Traits\HelpersTraits;

trait LangTrait
{
  public function getAllDescAttribute() {
    return $this->getRelationValue('all_desc')->keyBy('language_id');
  }

  public function desc_lang() {
    return $this->desc()->whereHas('language', function ($query) {
      return $query->where('short_code', app()->getLocale());
    });
  }

  public function all_desc_lang() {
    return $this->all_desc()->whereHas('language', function ($query) {
      return $query->where('short_code', app()->getLocale());
    });
  }
} // End class

