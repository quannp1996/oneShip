<?php

namespace App\Containers\Menu\Actions;

use App\Containers\Menu\Models\Menu;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class CreateMenuAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->all();
        $menu = Apiato::call('Menu@CreateMenuTask', [$data]);
        $this->clearCache();

        return $menu;
    }
}
