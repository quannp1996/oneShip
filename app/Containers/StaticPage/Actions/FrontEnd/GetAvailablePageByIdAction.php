<?php

namespace App\Containers\StaticPage\Actions\FrontEnd;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Localization\Models\Language;
use App\Ship\Parents\Actions\Action;

class GetAvailablePageByIdAction extends Action
{
    public function run($id, Language $currentLang = null, array $with = [], array $orderBy = [], $conditions = [], $selectFields = ['*'])
    {
        return Apiato::call('StaticPage@GetAvailablePageByIdTask', [$id, $currentLang],
            [
                ['where' => [$conditions]],
                ['orderBy' => [$orderBy]],
                ['with' => [$with]],
                ['selectFields' => [$selectFields]]
            ]
        );
    }
}
