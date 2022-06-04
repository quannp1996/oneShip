<?php

namespace App\Containers\ShippingUnit\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class ShippingUnitRepository
 */
class ShippingUnitRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
