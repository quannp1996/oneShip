<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-09 01:30:53
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-08-29 14:29:48
 * @ Description: Happy Coding!
 */

namespace App\Containers\Location\UI\API\Transformers\FrontEnd;

use App\Ship\Parents\Transformers\Transformer;

class DistrictListTransformer extends Transformer
{
    public function transform($data)
    {
        return [
            'id' => $data->id,
            'name' => $data->name,
            'safe_title' => $data->safe_title,
            'type' => $data->type
        ];
    }
}
