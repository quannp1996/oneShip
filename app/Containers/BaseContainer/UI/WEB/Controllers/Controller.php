<?php

namespace App\Containers\BaseContainer\UI\WEB\Controllers;

use App\Ship\core\Traits\HelpersTraits\ApiResTrait;
use App\Ship\Parents\Controllers\WebController;

class Controller extends WebController
{
  use ApiResTrait;
  // Tạm thời ko extends tránh queery không cần thiết
  public function renderItem() {
    $renderInput = request()->all();
    $html = view($renderInput['viewRender'], [
      'item' => $renderInput
    ])->render();

    return $this->sendResponse($html);
  }
} // End class
