<?php

namespace App\Containers\StaticPage\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\StaticPage\Models\StaticPage;
use App\Ship\Parents\Actions\Action;

/**
 * Class DeleteBannerAction.
 *
 */
class DeleteStaticPageAction extends Action
{

    /**
     * @return mixed
     */
    public function run($data)
    {
        Apiato::call('StaticPage@DeleteStaticPageTask', [$data->id]);
        Apiato::call('StaticPage@DeleteStaticPageDescTask', [$data->id]);
    }
}
