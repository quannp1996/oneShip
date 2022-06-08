<?php

namespace App\Containers\StaticPage\Actions\Admin;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\SubAction;

/**
 * Class FindBannerByIdAction.
 *
 */
class FindStaticPageByIDSubAction extends SubAction
{

    /**
     * @return mixed
     */
    public function run($id)
    {
        $data = Apiato::call('StaticPage@FindStaticPageByIDTask', [
            $id,
            Apiato::call('Localization@GetDefaultLanguageTask'),
        ]);

        if ($data) {
            $data->setRelation('all_desc', $data->all_desc->keyBy('language_id'));
        }

        return $data;
    }
}
