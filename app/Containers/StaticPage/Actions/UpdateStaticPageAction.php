<?php

namespace App\Containers\StaticPage\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\StaticPage\Models\StaticPage;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class UpdateBannerAction.
 *
 */
class UpdateStaticPageAction extends Action
{

    /**
     * @return mixed
     */
    public function run($data, Request $request)
    {
        $object = Apiato::call('StaticPage@SaveStaticPageTask', [$data]);
        if($object) {
            $original_desc = Apiato::call('StaticPage@GetAllStaticPageDescTask', [$object->id]);
            $ok = Apiato::call('StaticPage@SaveStaticPageDescTask', [$data, $original_desc, $object->id,$request]);
            if($ok) $object = Apiato::call('StaticPage@Admin\FindStaticPageByIDSubAction', [$object->id]);
        }
        return $object;
    }
}
