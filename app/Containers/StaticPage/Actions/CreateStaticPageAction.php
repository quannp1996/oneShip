<?php

namespace App\Containers\StaticPage\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\StaticPage\Models\StaticPage;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class CreateBannerAction.
 *
 */
class CreateStaticPageAction extends Action
{

    /**
     * @return mixed
     */
    public function run($data,Request $request)
    {
        $object = Apiato::call(
            'StaticPage@CreateStaticPageTask',
            [
                $data
            ]
        );
        if ($object) {
            $ok = Apiato::call('StaticPage@SaveStaticPageDescTask', [
                $data,
                [],
                $object->id,
                $request
            ]);
            if($ok){
                
            }
        }

        return $object;
    }
}
