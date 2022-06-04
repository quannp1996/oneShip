<?php

namespace App\Containers\Banner\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Banner\Models\Banner;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Exception;

/**
 * Class UpdateBannerAction.
 *
 */
class DisableBannerAction extends Action
{

    /**
     * @return mixed
     */
    public function run(DataTransporter $data)
    {
        $banner = Apiato::call('Banner@DisableBannerTask', [$data->id]);

        $this->clearCache();

        return $banner;
    }
}
