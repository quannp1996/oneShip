<?php

namespace App\Containers\Menu\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class FindMenuByIdAction extends Action
{
    public function run(Request $request, array $with=[])
    {
        $menu = Apiato::call('Menu@FindMenuByIdTask', [$request->id, $with]);
        return $menu;
    }
}
