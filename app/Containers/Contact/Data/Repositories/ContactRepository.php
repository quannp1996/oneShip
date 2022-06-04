<?php

namespace App\Containers\Contact\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class ContactRepository
 */
class ContactRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
