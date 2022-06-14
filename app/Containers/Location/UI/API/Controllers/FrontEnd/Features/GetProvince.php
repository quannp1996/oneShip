<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-01 14:57:39
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-08-29 14:25:52
 * @ Description: Happy Coding!
 */

namespace App\Containers\Location\UI\API\Controllers\FrontEnd\Features;

use App\Containers\Location\Actions\GetAllCitiesAction;
use App\Containers\Location\UI\API\Requests\FrontEnd\GetLocationRequest;

trait GetProvince
{
    public function GetProvinces(GetLocationRequest $request, GetAllCitiesAction $getAllCitiesAction)
    {
        $provices = $getAllCitiesAction->run(false, 100,'name asc',[]);
        return $this->sendResponse([
            'provinces' => $provices
        ]);
    }
}
