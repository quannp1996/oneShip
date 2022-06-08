<?php

namespace App\Containers\Customer\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class CountFollowContractorAction extends Action
{
    public function run(array $where=[]): int
    {
        $customerfollow = Apiato::call('Customer@CountFollowContractorTask', [$where]);

        return $customerfollow;
    }
}
