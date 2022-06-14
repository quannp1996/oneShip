<?php

namespace App\Containers\ShippingUnit\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class ShippingConstRepository
 */
class ShippingConstRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
