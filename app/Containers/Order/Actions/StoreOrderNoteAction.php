<?php

namespace App\Containers\Order\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

class StoreOrderNoteAction extends Action
{
    public function run(DataTransporter $dataTransporter)
    {
      $ordernote = Apiato::call('Order@StoreOrderNoteTask', [$dataTransporter->toArray()]);
      // $ordernote->load('user:id,email,name');
      return $ordernote;
    }
}
