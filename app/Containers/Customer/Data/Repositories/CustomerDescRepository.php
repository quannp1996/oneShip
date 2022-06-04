<?php

namespace App\Containers\Customer\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class CustomerDescRepository
 */
class CustomerDescRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
