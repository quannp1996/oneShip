<?php

namespace App\Containers\Order\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class OrderNoteRepository
 */
class OrderNoteRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
