<?php

namespace App\Containers\Customer\Data\Repositories;

use Apiato\Core\Abstracts\Repositories\Contracts\UserRepositoryInterface;
use App\Ship\Parents\Repositories\Repository;

/**
 * Class UserRepository.
 *
 * @author Mahmoud Zalt  <mahmoud@zalt.me>
 */
class UserRepository extends Repository implements UserRepositoryInterface
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'       => 'like',
        'id'         => '=',
        'email'      => '=',
        'confirmed'  => '=',
        'created_at' => 'like',
    ];

}
