<?php

namespace App\Containers\Customer\UI\API\Controllers;

use App\Containers\Customer\Actions\GetAllCustomersAction;
use App\Containers\Customer\UI\API\Requests\APIGetAllCustomerRequest;
use App\Containers\BaseContainer\UI\WEB\Controllers\BaseApiFrontController;
use App\Containers\Customer\UI\API\Transformers\FrontEnd\CustomersTransfomer;

/**
 * Class Controller.
 *
 * @author Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Controller extends BaseApiFrontController
{

    public function listUsers(APIGetAllCustomerRequest $request, GetAllCustomersAction $getAllCustomersAction)
    {
        $customers = $getAllCustomersAction->run($request->toTransporter(), false);
        return $this->transform($customers, CustomersTransfomer::class);
    }
}
