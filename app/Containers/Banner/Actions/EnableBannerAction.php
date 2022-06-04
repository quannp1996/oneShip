<?php

namespace App\Containers\Banner\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Banner\Models\Banner;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

/**
 * Class UpdateBannerAction.
 *
 */
class EnableBannerAction extends Action
{

    /**
     * @return mixed
     */
    public function run(DataTransporter $data)
    {
        $banner = Apiato::call('Banner@EnableBannerTask', [$data->id]);

        $this->clearCache();

        return $banner;
    }
}
