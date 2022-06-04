<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

/**
 * Class GetOptStatusAction.
 *
 *
 */
class GetOptStatusAction extends Action
{

    /**
     * @return mixed
     */
    public function run()
    {
        return Apiato::call('User@GetOptStatusTask');
    }
}