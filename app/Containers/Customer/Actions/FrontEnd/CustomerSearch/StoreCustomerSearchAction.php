<?php

namespace App\Containers\Customer\Actions\FrontEnd\CustomerSearch;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Customer\Tasks\CustomerSearch\CreateCustomerSearchTask;
use App\Containers\Customer\Tasks\CustomerSearch\GetKeySearchByCustomerTask;
use App\Containers\Customer\Tasks\CustomerSearch\DeleteCustomerSearchTask;

class StoreCustomerSearchAction extends Action
{
    public function run(array $data)
    {
        $object=[];
        $keySearch=app(GetKeySearchByCustomerTask::class)->run($data['customer_id']);
        if($keySearch->count()==10){
            app(DeleteCustomerSearchTask::class)->run($keySearch[9]->id);
        }
        if($keySearch->where('key_search',$data['key_search'])->count()==0){
            $object =app(CreateCustomerSearchTask::class)->run($data);
        }
       
        return $object;
    }
}
