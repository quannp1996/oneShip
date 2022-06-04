<?php

namespace App\Containers\Banner\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Banner\Models\Banner;
use App\Ship\Parents\Actions\Action;

class UpdateBannerAction extends Action
{
    public function run($data)
    {
        $beforeData = Apiato::call('Banner@FindBannerByIdTask', [$data['id']]);
        $banner = Apiato::call('Banner@SaveBannerTask', [$data]);
        if ($banner) {
            $original_desc = Apiato::call('Banner@GetAllBannerDescTask', [$banner->id]);
            Apiato::call('Banner@SaveBannerDescTask', [
                $data,
                $original_desc,
                $banner->id
            ]);
        }
        
        $this->clearCache();

        return $banner;
    }
}
