<?php

namespace App\Containers\StaticPage\Actions\Admin;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

/**
 * Class FindBannerByIdAction.
 *
 */
class FindStaticPageByIDAction extends Action
{

    /**
     * @return mixed
     */
    public function run($id, array $external_data = ['with_relationship' => ['all_desc']])
    {
        $data = Apiato::call('StaticPage@FindStaticPageByIDTask', [
            $id,
            Apiato::call('Localization@GetDefaultLanguageTask'),
            $external_data
        ]);

        if ($data) {
            $data->setRelation('all_desc', $data->all_desc->keyBy('language_id'));
        }

        return $data;
    }
}
