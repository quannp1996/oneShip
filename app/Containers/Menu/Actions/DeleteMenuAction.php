<?php

namespace App\Containers\Menu\Actions;

use App\Containers\Menu\Models\Menu;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class DeleteMenuAction extends Action
{
    public function run(Request $request)
    {
        $result = Apiato::call('Menu@DeleteMenuTask', [$request->id]);

        $this->clearCache();

        return $result;
    }
}
