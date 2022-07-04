<?php

namespace App\Containers\ShippingUnit\UI\WEB\Controllers\FrontEnd;

use App\Containers\BaseContainer\UI\WEB\Controllers\NeedAuthController;
use App\Containers\ShippingUnit\Actions\GetAllShippingUnitsAction;
use App\Containers\ShippingUnit\Business\ShippingFactory;
use App\Containers\ShippingUnit\UI\API\Requests\FrontEnd\CaculateShippingFeesRequest;
use App\Containers\ShippingUnit\UI\WEB\Transformers\ShippingFeesTransformer;
use App\Containers\ShippingUnit\Values\DonHang;
use App\Ship\core\Traits\HelpersTraits\ApiResTrait;

/**
 * Class Controller
 *
 * @package App\Containers\ShippingUnit\UI\WEB\Controllers
 */
class Controller extends NeedAuthController
{
    use ApiResTrait;

    public function caculateFees(CaculateShippingFeesRequest $request, GetAllShippingUnitsAction $getAllShippingUnitsAction)
    {
        try{
            $user = auth('customer')->user();
            $allShippings = $getAllShippingUnitsAction->setPagination(false)->run([], ['consts', 'services']);
            $allShippings->map(function($item) use($user, $request) {
                $shippingFee = ShippingFactory::getInstance($item);
                $shippingFee->setCustomer($user);
                $shippingFee->setDonhang(new DonHang([
                    'sender' => $request->sender,
                    'receiver' => $request->sender,
                    'package' => $request->package
                ]));
                $item->fee = $shippingFee->caculateShipping();
            });
            return $this->sendResponse([
                'shippings' => $allShippings->map(function($item, $index) {
                    return [
                        'id' => $item->id, 
                        'id2' => $index + 1, 
                        'title' => $item->title,
                        'time_pickup' => $item->time,
                        'fee' => $item->fee,
                        'image' => $item->getImageUrl()
                    ];
                })
            ], 'Thông tin phí');
            return $this->transform($allShippings, new ShippingFeesTransformer());
        }catch(\Exception $e){
            $this->sendError('FORBIDDEN', 403, $e->getMessage());
        }
    }
}
