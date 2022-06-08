<?php

namespace App\Containers\Menu\Actions;

use App\Containers\Menu\Models\Menu;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class UpdateMenuAction extends Action
{
    public function run($request)
    {
        $data = $request->all();
        $menu = Apiato::call('Menu@UpdateMenuTask', [$request->id, $data]);
        $this->clearCache();
        return $menu;
    }
}
