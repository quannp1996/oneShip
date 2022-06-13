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

use App\Containers\Location\Actions\GetAllDistrictsAction;
use App\Containers\Location\UI\API\Requests\FrontEnd\GetLocationRequest;
use App\Containers\Location\UI\API\Transformers\FrontEnd\DistrictListTransformer;

trait GetDistrict
{
    public function GetDistricts(GetLocationRequest $request, GetAllDistrictsAction $getAllDistrictsAction)
    {
        $districts = $getAllDistrictsAction->run(false, 100000,'name asc',[], [
            'province_id' => $request->provinceId
        ]);
        return $this->transform($districts, DistrictListTransformer::class, [], [], 'districts');
    }
}
