<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-30 12:38:32
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-30 12:42:10
 * @ Description: Happy Coding!
 *  Class Serial này trả về dữ liệu thuần, không thêm bớt các key(s)
 */

namespace Apiato\Core\Transformers\Serializers;

use League\Fractal\Serializer\ArraySerializer;

class PureArraySerializer extends ArraySerializer
{
    public function collection(?string $resourceKey, array $data): array
    {
        return  $data;
    }
}
