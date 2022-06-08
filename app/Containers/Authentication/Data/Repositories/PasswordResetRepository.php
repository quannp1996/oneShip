<?php

namespace App\Containers\Authentication\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class CommentBadWordRepository
 */
class PasswordResetRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
    ];

}
