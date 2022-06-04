<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authorization\Models\Role;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use function is_null;

/**
 * Class CreateRoleAction
 *
 */
class UpdateRoleAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  \App\Containers\Authorization\Models\Role
     */
    public function run(DataTransporter $data): Role
    {
        $level = is_null($data->level) ? 0 : $data->level ;

        $bool = Apiato::call('Authorization@UpdateRoleTask',
            [$data->id, $data->description, $data->display_name, $level]
        );

        if($bool) {
            $role = Apiato::call('Authorization@FindRoleTask',[$data->id]);
            // convert to array in case single ID was passed
            $permissionIds = (array)$data->permissions_ids;

            $permissions = array_map(function ($permissionId) {
                return Apiato::call('Authorization@FindPermissionTask', [$permissionId]);
            }, $permissionIds);
    
            $role = $role->syncPermissions($permissions);
        }else {
            $role = null;
        }

        return $role;
    }
}
