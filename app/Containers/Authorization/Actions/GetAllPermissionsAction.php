<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class GetAllPermissionsAction extends Action
{

    /**
     * @return  mixed
     */
    public function run(DataTransporter $data,$limit = 10)
    {
        $permissions = Apiato::call('Authorization@GetAllPermissionsTask', [false,$limit,$data], [
            'addRequestCriteria',
            'ordereByContainer',
            'ordereByCreated'
        ]);

        return $permissions;
    }

}
