<?php

namespace App\Containers\BaseContainer\Tasks\Admin;

use Apiato\Core\Foundation\Facades\StringLib;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class SaveModelDescTask extends Task
{
    public function run($repositoryInstance, $data = [], $originalDesc = [], $parentObjId = [], $foreignKey = '')
    {

            $description = isset($data['description']) ? (array)$data['description'] : null;
            // dd($description, $repositoryInstance, $data, $originalDesc, $parentObjId, $foreignKey);

            if (!empty($description) && is_array($description)) {
                $updates = [];
                $inserts = [];

                foreach ($description as $langId => $descByLang) {

                    if (array_key_exists('slug', $descByLang)) {
                        $descByLang['slug'] = isset($descByLang['slug']) && $descByLang['slug'] != '' ? StringLib::slug($descByLang['slug']) : StringLib::slug($descByLang['name']);
                    }

                    if (isset($originalDesc[$langId])) {
                        $updates[$originalDesc[$langId]['id']] = $descByLang;
                    } else {
                        $inserts[] = array_merge([
                            $foreignKey => $parentObjId,
                            'language_id' => $langId,
                        ], $descByLang);
                    }
                }
                //dd($description, $updates, $inserts);

                if (!empty($updates)) {
                    $repositoryInstance->updateMultiple($updates);
                }

                if (!empty($inserts)) {
                     $repositoryInstance->getModel()->insert($inserts);
                }
            }


    }
}
