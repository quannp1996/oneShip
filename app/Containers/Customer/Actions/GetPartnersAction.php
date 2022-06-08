<?php

namespace App\Containers\Customer\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Contractor\Data\Repositories\ContractorRepository;
use App\Ship\Parents\Actions\Action;

class GetPartnersAction extends Action
{
    public function run(int $customerID, array $selectColumn = ['*'])
    {
        return Apiato::call('Customer@GetPartnersTask', [
            $customerID, $selectColumn
        ]);
    }
}
