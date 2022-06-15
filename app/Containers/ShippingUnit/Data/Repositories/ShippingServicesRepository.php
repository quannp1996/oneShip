<?php

namespace App\Containers\ShippingUnit\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class ShippingServicesRepository
 */
class ShippingServicesRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
