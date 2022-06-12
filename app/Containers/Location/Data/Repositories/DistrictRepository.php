<?php

namespace App\Containers\Location\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class DistrictRepository
 */
class DistrictRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
