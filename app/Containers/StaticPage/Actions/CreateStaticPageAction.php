<?php

namespace App\Containers\StaticPage\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\StaticPage\Models\StaticPage;
use App\Containers\StaticPage\Tasks\CreateStaticPageTask;
use App\Containers\StaticPage\Tasks\SaveStaticPageDescTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Exception;

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
        try{
            $object = app(CreateStaticPageTask::class)->run($data);
            if ($object) app(SaveStaticPageDescTask::class)->run($data, [], $object->id, $request);
            return $object;
        }catch(Exception $e){
            return $e;
        }
    }
}
