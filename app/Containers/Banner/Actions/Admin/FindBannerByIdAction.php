<?php

namespace App\Containers\Banner\Actions\Admin;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

/**
 * Class FindBannerByIdAction.
 *
 */
class FindBannerByIdAction extends Action
{

    /**
     * @return mixed
     */
    public function run($banner_id)
    {
        $data = Apiato::call('Banner@FindBannerByIdTask', [
            $banner_id,
            Apiato::call('Localization@GetDefaultLanguageTask'),
            ['with_relationship' => ['all_desc']]
        ]);

//        if ($data) {
//            $data->setRelation('all_desc', $data->all_desc->keyBy('language_id'));
//        }

        return $data;
    }
}
