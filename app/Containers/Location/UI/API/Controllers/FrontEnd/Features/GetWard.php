<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-01 14:57:39
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-08-29 15:05:47
 * @ Description: Happy Coding!
 */

namespace App\Containers\Location\UI\API\Controllers\FrontEnd\Features;

use App\Containers\Location\Actions\GetAllWardsAction;
use App\Containers\Location\UI\API\Requests\FrontEnd\GetLocationRequest;
use App\Containers\Location\UI\API\Transformers\FrontEnd\WardListTransformer;

trait GetWard
{
    public function GetWards(GetLocationRequest $request, GetAllWardsAction $getAllWardsAction)
    {
        $wards = $getAllWardsAction->run(false,20,'name desc', [], [
            'district_id' =>  $request->districtId
        ]);

        return $this->transform($wards, WardListTransformer::class, [], [], 'wards');
    }
}
