<?php

namespace App\Containers\User\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class UserLogRepository.
 *
 * @author Ha Ly Manh <halymanh@vccorp.com>
 */
class UserLogRepository extends Repository
{

    //protected $container = 'User';

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'         => '=',
//        'created_at' => 'like',
    ];

}
