<?php

namespace App\Containers\StaticPage\Actions\FrontEnd;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Localization\Models\Language;
use App\Ship\Parents\Actions\Action;


class GetAvailablePageByPositionAction extends Action
{

    public function run(array $positions = [], bool $isMobile, array $with = [], array $orderBy = [], $selectFields = ['*'],Language $currentLang = null,$limit = 0)
    {
        return Apiato::call('StaticPage@GetAvailablePageByPositionTask', [$positions,$currentLang,$limit],
            [
                ['orderBy' => [$orderBy]],
                ['with' => [$with]],
                ['mobile' => [$isMobile]],
                ['selectFields' => [$selectFields]]
            ]
        );
    }
}
