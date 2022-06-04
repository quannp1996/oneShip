<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-01 00:30:59
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-08-09 04:05:46
 * @ Description: Happy Coding!
 */

namespace App\Ship\core\Traits\HelpersTraits;

trait UpdateDynamicStatusTrait
{
    public function updateDynamicStatus(string $field,int $id, int $status,string $id_alias_field = '') :? bool
    {
        if (!empty($field) && $id > 0) {
            return $this->repository->getModel()->where($id_alias_field ? $id_alias_field : 'id', $id)->update([$field => $status]);
        }

        return false;
    }
}
