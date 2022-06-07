<?php

namespace App\Containers\Customer\Data\Repositories;

use Apiato\Core\Abstracts\Repositories\Contracts\UserRepositoryInterface;
use App\Ship\Parents\Repositories\Repository;

/**
 * Class CustomerRepository
 */
class CustomerRepository extends Repository implements UserRepositoryInterface
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        'fullname' => 'LIKE',
        'email' => 'LIKE',
        'phone' => 'LIKE'
    ];

    public function boot(){
      $this->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
    }
}
