<?php

namespace App\Containers\Customer\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class CustomerRefRevenueRepository
 */
class CustomerRefRevenueRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
