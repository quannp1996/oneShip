<?php

namespace App\Containers\StaticPage\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Localization\Models\Language;
use App\Ship\Parents\Actions\Action;

/**
 * Class BannerListingAction.
 *
 */
class ListStaticPageAction extends Action
{
    public function run($filters, $limit = 10, $external_data = [], Language $currentLang = null )
    {
        $data = Apiato::call(
            'StaticPage@ListStaticPageTask',
            [
                $filters,
                ['created_at' => 'desc'],
                $limit,
                $currentLang,
                $external_data,
            ]
        );
        return $data;
    }
}
