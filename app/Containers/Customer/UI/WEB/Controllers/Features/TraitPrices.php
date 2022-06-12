<?php 
namespace App\Containers\Customer\UI\WEB\Controllers\Features;

use App\Containers\Customer\Actions\FindCustomerByIdAction;
use App\Containers\Customer\UI\WEB\Requests\Prices\SetupPriceCustomerRequest;

trait TraitPrices{
    
    public function setUpPrice(SetupPriceCustomerRequest $request)
    {
        $user = app(FindCustomerByIdAction::class)->run($request->userID);
        $listPrices = !empty($user->prices) ? json_decode($user->prices, true) : [];
        $listPrices[$request->shippingID] = [
            'shippingID' => $request->shippingID,
            'constID' => $request->constID
        ];
        $user->prices = json_encode($listPrices);
        $user->save();
       return $this->sendResponse([], '');
    }
}
