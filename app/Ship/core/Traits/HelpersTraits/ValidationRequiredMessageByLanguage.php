<?php

namespace App\Ship\core\Traits\HelpersTraits;

use App\Containers\Localization\Tasks\GetAllLanguageDBTask;

trait ValidationRequiredMessageByLanguage
{
  public function messages()
  {
      $languages = app(GetAllLanguageDBTask::class)->run();
      $message = parent::messages();
      if($this->fieldDesc){
        foreach($languages AS $language){
          foreach($this->fieldRequired AS $key => $value){
            $message[
              sprintf('%s.%d.%s.required', $this->fieldDesc, $language->language_id, $key)
            ] = sprintf('%s (%s) là trường bắt buộc', $value, $language->name);
          }
        }
        return $message;
      }
      return $message;
  }
}


