<?php

namespace App\Containers\Banner\Tasks;

use App\Containers\Banner\Data\Repositories\BannerDescRepository;
use App\Ship\Parents\Tasks\Task;

/**
 * Class SaveBannerDescTask.
 */
class SaveBannerDescTask extends Task
{

    protected $repository;

    public function __construct(BannerDescRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     *
     * @return  mixed
     */
    public function run($data, $original_desc, $banner_id, $edit_id = null)
    {
        $banner_description = isset($data['banner_description']) ? $data['banner_description'] : null;
        if (is_array($banner_description) && !empty($banner_description)) {
            $updates = [];
            $inserts = [];
            foreach ($banner_description as $k => $v) {
                $attrItem = [];
                if (!empty($v['item'])) {
                    $count = count(array_filter($v['item']['item_title']));

                    for ($i = 0; $i < $count; $i++) {
                        $attrItem[] = [
                            'item_title' => $v['item']['item_title'][$i],
                            'item_link' => $v['item']['item_link'][$i],
                            'item_description' => $v['item']['item_description'][$i],
                        ];

                    }
                }
                if (isset($original_desc[$k])) {
                    $updates[$original_desc[$k]['id']] = [
                        'name' => $v['name'],
                        'short_description' => $v['short_description'],
                        'link' => @$v['link'],
                        'image' => $data['image'] ?? @$data['old_image'],
                        'item' => json_encode($attrItem),
                    ];
                    if (isset($data['image']) && !empty($data['image'])) {
                        $updates[$original_desc[$k]['id']]['image'] = $data['image'];
                    }

                } else {
                    $inserts[] = [
                        'banner_id' => $banner_id,
                        'language_id' => $k,
                        'link' => @$v['link'],
                        'name' => $v['name'],
                        'short_description' => $v['short_description'],
                        'image' => $data['image'] ?? '',
                        'item' => json_encode($attrItem),
                    ];
                }

            }
            if (!empty($updates)) {
                foreach($updates AS $key => $argv){
                    $this->repository->update($argv, $key);
                }
            }

            if (!empty($inserts)) {
                $this->repository->getModel()->insert($inserts);
            }
        }
    }
}
