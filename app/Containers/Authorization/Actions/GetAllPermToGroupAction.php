<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

/**
 * Class GetAllPermissionsAction.
 *
 * @author Mahmoud Zalt  <mahmoud@zalt.me>
 */
class GetAllPermToGroupAction extends Action
{

    /**
     * @return  mixed
     */
    public function run(array $guards=['admin'])
    {
        $criteria[] = ['inGuards' => [$guards]];

        $permissions = Apiato::call('Authorization@GetAllPermissionsTask', [true], array_merge([
          'addRequestCriteria',
          'ordereByContainer',
          'ordereByCreated',
          'filterByGuards'
        ], $criteria));

        if(!empty($permissions) && !$permissions->isEmpty() ) {
            $arrGrouped = [];
            foreach($permissions as $item) {
                $arrGrouped[$item->containers][] = $item;
            }
        }

        return $arrGrouped;
    }

}
