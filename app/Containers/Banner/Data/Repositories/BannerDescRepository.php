<?php

namespace App\Containers\Banner\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class BannerDescRepository.
 */
class BannerDescRepository extends Repository
{

    /**
     * the container name. Must be set when the model has different name than the container
     *
     * @var  string
     */
    protected $container = 'Banner';

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'news_id',
        'language_id',
        'name',
        'tag',
    ];
}
