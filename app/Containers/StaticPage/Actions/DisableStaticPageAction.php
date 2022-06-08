<?php

namespace App\Containers\StaticPage\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\StaticPage\Models\StaticPage;
use App\Ship\Parents\Actions\Action;


/**
 * Class UpdateBannerAction.
 *
 */
class DisableStaticPageAction extends Action
{

    /**
     * @return mixed
     */
    public function run($data)
    {
        $object = Apiato::call(
            'StaticPage@DisableStaticPageTask',
            [
                $data->id
            ]
        );

        return $object;
    }
}
