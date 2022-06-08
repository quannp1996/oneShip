<?php

namespace App\Containers\Menu\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class UpdatePositionAction extends Action
{
  public function run($request)
  {
    $data = $request->sanitizeInput(['menus']);

    $menus = json_decode($data['menus'], true);
    $result = Apiato::call('Menu@UpdatePositionMenuTask', [$menus]);

    $this->clearCache();

    return $result;
  }
} // End class
