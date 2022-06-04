<?php

namespace App\Containers\Menu\Actions;

use App\Containers\Localization\Models\Language;
use App\Ship\Parents\Actions\Action;
use App\Containers\Menu\Tasks\GetMenusAdminSidebarTask;
use App\Containers\Menu\Tasks\GetMenusByTypeTask;
use App\Ship\core\Traits\HelpersTraits\RecursiveTrait;
use App\Containers\Localization\Actions\GetCurrentLangAction;

class GetMenusByTypeAction extends Action
{
    use RecursiveTrait;

    public function run($menuType = '1', bool $hasBuildTree = false, ?Language $currentLang = null, array $conditions = [], array $with = [])
    {
        return $this->remember(function () use ($menuType, $hasBuildTree, $currentLang, $conditions, $with) {
            if ($menuType == config('menu-container.type_key.sidebar_admin') && $hasBuildTree) {
                $menus = app(GetMenusAdminSidebarTask::class)->run($menuType, ['desc_lang']);
            } else {
                $menus = app(GetMenusByTypeTask::class)
                    ->currentLang(app(GetCurrentLangAction::class)->run())
                    ->where($conditions)
                    ->with($with)
                    ->run($menuType, ['desc_lang']);
            }
            // dd($menus);
            return $menus;
        });
    }
}
