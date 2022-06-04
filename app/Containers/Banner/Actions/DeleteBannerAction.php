<?php

namespace App\Containers\Banner\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Banner\Models\Banner;
use App\Ship\Parents\Actions\Action;

/**
 * Class DeleteBannerAction.
 *
 */
class DeleteBannerAction extends Action
{

    /**
     * @return mixed
     */
    public function run($data)
    {
        Apiato::call('Banner@DeleteBannerTask', [$data->id]);
        Apiato::call('Banner@DeleteBannerDescTask', [$data->id]);

        $this->clearCache();
    }
}
