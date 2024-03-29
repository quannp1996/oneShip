<?php 
namespace App\Containers\Customer\UI\WEB\Controllers\Admin\Features;

use App\Containers\Customer\Actions\FindCustomerByIdAction;
use App\Containers\Customer\UI\WEB\Requests\ShowDetailCustomerRequest;

trait TraitBase{
    
    public function show(ShowDetailCustomerRequest $request, FindCustomerByIdAction $findCustomerByIdAction)
    {
        $customer = $findCustomerByIdAction->run($request->id, ['orders']);
        return view('customer::show', [
            'customer' => $customer
        ]);
    }
}
?>