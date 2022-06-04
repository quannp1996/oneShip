<?php

namespace App\Containers\Banner\Actions;

use App\Containers\Banner\Actions\SubActions\GetAvailableBannerByPositionSubAction;
use App\Ship\Parents\Actions\Action;
use App\Containers\Localization\Models\Language;
use Illuminate\Database\Eloquent\Collection;

class GetAvailableBannerByPositionAction extends Action
{
    public function run(array $positions = [], bool $isMobile, array $with = [], array $orderBy = [], Language $currentLang, int $limit = 0): Collection
    {
        return $this->remember(function () use ($positions, $isMobile, $with, $orderBy, $currentLang, $limit) {
                return app(GetAvailableBannerByPositionSubAction::class)->run($positions, $isMobile, $with, $orderBy, $currentLang, $limit);
            }
        );
    }
}
