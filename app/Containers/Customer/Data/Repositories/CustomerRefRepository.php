<?php

namespace App\Containers\Customer\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class CustomerRefRepository
 */
class CustomerRefRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
