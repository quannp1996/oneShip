<?php

namespace App\Containers\Order\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class FindNoteByLogAction extends Action
{
    public function run(int $order_id,string $action_key, array $column=['*'])
    {
      $criteria = [
        ['selectFields' => [$column]]
      ];
      $notes = Apiato::call('Order@FindNoteByLogTask', [$order_id,$action_key], $criteria);

      return $notes;
    }
}
