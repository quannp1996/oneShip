<?php

namespace App\Containers\Banner\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Banner\Models\Banner;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

/**
 * Class CreateBannerAction.
 *
 */
class CreateBannerAction extends Action
{

    /**
     * @return mixed
     */
    public function run($data)
    {
        $banner = Apiato::call('Banner@CreateBannerTask',[$data]);

        if ($banner) {
            Apiato::call('Banner@SaveBannerDescTask', [$data, [], $banner->id]);
        }

        $this->clearCache();

        return $banner;
    }
}
