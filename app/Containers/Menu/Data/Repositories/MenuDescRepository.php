<?php

namespace App\Containers\Menu\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class MenuDescRepository
 */
class MenuDescRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
