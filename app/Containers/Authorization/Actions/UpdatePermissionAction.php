<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authorization\Models\Permission;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class UpdatePermissionAction extends Action
{
    public function run(DataTransporter $data): Permission
    {
        $bool = Apiato::call('Authorization@UpdatePermissionTask',
            [$data->id, $data->description, $data->display_name]
        );

        if($bool) {
            $permission = Apiato::call('Authorization@FindPermissionTask', [$data->id]);   
        }else {
            $permission = null;
        }

        return $permission;
    }
}
