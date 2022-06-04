<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-17 17:14:35
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-22 00:02:53
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\Tasks\PaymentType;

use App\Containers\Settings\Data\Repositories\PaymentTypeDescRepository;
use App\Ship\Parents\Tasks\Task;

class SavePaymentTypeDescTask extends Task
{

    protected $repository;

    public function __construct(PaymentTypeDescRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     *
     * @return  mixed
     */
    public function run($data, $original_desc, $id, $edit_id = null)
    {
        $description = isset($data['description']) ? (array)$data['description'] : null;
        if (is_array($description) && !empty($description)) {
            $updates = [];
            $inserts = [];
            foreach ($description as $k => $v) {
                if (isset($original_desc[$k])) {
                    $updates[$original_desc[$k]['id']] = [
                        'name' => $v['name'],
                        // 'link' => $v['link'],
                        'short_description' => $v['short_description'],
                    ];
                    if(isset($data['image']) && !empty($data['image'])){
                        $updates[$original_desc[$k]['id']]['image'] = $data['image'];
                    }
                } else {
                    $inserts[] = [
                        'payment_type_id' => $id,
                        'language_id' => $k,
                        'name' => $v['name'],
                        // 'link' => $v['link'],
                        'short_description' => $v['short_description'],
                        'image' => $data['image'] ?? '',
                    ];
                }
            }
            if (!empty($updates)) {
                $this->repository->updateMultiple($updates);
            }

            if (!empty($inserts)) {
                $this->repository->getModel()->insert($inserts);
            }
        }
    }
}
