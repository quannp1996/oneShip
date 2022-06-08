<?php

namespace App\Containers\StaticPage\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class BannerRepository.
 */
class StaticPageRepository extends Repository
{

    /**
     * the container name. Must be set when the model has different name than the container
     *
     * @var  string
     */
    protected $container = 'StaticPage';

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'status',
        'created_at',
    ];
}
