<?php

namespace App\Containers\Banner\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class BannerRepository.
 */
class BannerRepository extends Repository
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
        'status',
        'publish_at',
        'position',
        'views',
        'is_mobile',
        'created_at',
    ];
}
