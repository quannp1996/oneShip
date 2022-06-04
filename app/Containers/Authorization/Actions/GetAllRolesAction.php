<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

/**
 * Class GetAllRolesAction.
 *
 * @author Mahmoud Zalt  <mahmoud@zalt.me>
 */
class GetAllRolesAction extends Action
{

    /**
     * @return mixed
     */
    public function run(DataTransporter $data, $limit = 10, $skipPagination = false, $guards=['admin'])
    {
        $criterias = [];
        if ($data->name) {
            $criterias[] = ['equalName' => [$data->name]];
        }

        if ($data->display_name) {
            $criterias[] = ['likeDispName' => [$data->display_name]];
        }

        $criterias[] = ['inGuards' => [$guards]];

        $roles = Apiato::call('Authorization@GetAllRolesTask', [$skipPagination,$limit], array_merge([
            'addRequestCriteria'
        ],$criterias));

        return $roles;
    }

}
