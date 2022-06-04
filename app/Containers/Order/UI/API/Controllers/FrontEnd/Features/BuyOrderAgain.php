<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-21 12:34:39
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-11-30 17:57:32
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\UI\API\Controllers\FrontEnd\Features;

use App\Containers\Order\Actions\FindOrderByIdAction;
use App\Containers\Order\UI\API\Requests\FrontEnd\BuyOrderAgainRequest;
use App\Containers\Product\Actions\FrontEnd\PreCheckingToAddCartItemAction;
use App\Containers\ShoppingCart\Actions\FrontEnd\AddCartItemAction;
use App\Containers\ShoppingCart\Actions\FrontEnd\StoreCartAction;

trait BuyOrderAgain
{
    public function buyOrderAgain(BuyOrderAgainRequest $request)
    {
        $order = app(FindOrderByIdAction::class)->run($request->id, ['orderItems' => function ($q) {
            $q->where('variant_parent_id', 0);
        }, 'orderItems.product']);

        if (!empty($order) && isset($order->orderItems) && $order->orderItems->isNotEmpty()) {
            $arrayAddCartItems = [];
            foreach ($order->orderItems as $item) {
                $arrayAddCartItems[] = app(PreCheckingToAddCartItemAction::class)->currentLang($this->currentLang)->run(
                    $item->product_id,
                    $item->variant_id,
                    $item->quantity
                );
            }

            // dd($arrayAddCartItems);

            if (!empty($arrayAddCartItems)) {
                app(AddCartItemAction::class)->currentLang($this->currentLang)->instance()->add($arrayAddCartItems)->run();
            }

            if (!empty($arrayAddCartItems) && !empty($this->user->id)) {
                app(StoreCartAction::class)->currentLang($this->currentLang)->setIdentify($this->user->id)->instance()->run();
            }
        }

        return $this->sendResponse([
            'url' => routeFrontEndFromOthers('web_checkout_cart'),
        ]);
    }
}
