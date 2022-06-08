<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

/**
 * Class CreateUserLogAction.
 *
 * @author Ha Ly Manh <halymanh@vccorp.com>
 */
class CreateUserLogAction extends Action
{
    /**
     * @param int    $object_id
     * @param        $before
     * @param        $after
     * @param string $note
     * @param string $model
     */

    public function run(
        int $object_id = 0,
        $before = null,
        $after = null,
        string $note = '',
        string $model = ''
    ): void
    {
    }
}
