<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-10-03 23:03:53
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-03 23:05:28
 * @ Description: Happy Coding!
 */

namespace App\Containers\Banner\Actions\SubActions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Localization\Models\Language;
use App\Ship\Parents\Actions\SubAction;
use Illuminate\Database\Eloquent\Collection;

class GetAvailableBannerByPositionSubAction extends SubAction
{
    public function run(array $positions = [], bool $isMobile, array $with = [], array $orderBy = [], Language $currentLang, int $limit = 0): Collection
    {
        return Apiato::call(
            'Banner@GetAvailableBannerByPositionTask',
            [
                $positions,
                $currentLang ?? Apiato::call('Localization@GetDefaultLanguageTask'),
                $limit
            ],
            [
                [
                    'orderBy' => [$orderBy]
                ],
                [
                    'with' => [$with]
                ],
                'addRequestCriteria',
                [
                    'mobile' => [$isMobile]
                ],
            ]
        );
    }
}
