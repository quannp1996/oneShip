<?php

namespace App\Containers\Menu\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class GetAllMenusAction extends Action
{
    public $menuData = [];

    public function run(array $with=[]): array
    {
        $menus = Apiato::call('Menu@GetAllMenusTask', [$with], ['addRequestCriteria']);
        $menusArray = $menus->toArray();
        return $menusArray;
    }
}
