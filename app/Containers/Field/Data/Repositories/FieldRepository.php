<?php

namespace App\Containers\Field\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class FieldRepository
 */
class FieldRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
