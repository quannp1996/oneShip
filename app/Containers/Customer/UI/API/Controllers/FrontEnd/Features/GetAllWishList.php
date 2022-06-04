<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-01 14:57:39
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-11-17 16:30:19
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\UI\API\Controllers\FrontEnd\Features;

use App\Containers\Customer\UI\API\Requests\FrontEnd\GetAllWishListRequest;
use App\Containers\Customer\UI\API\Transformers\FrontEnd\WishListTransformer;
use App\Containers\Customer\Actions\FrontEnd\WishList\GetAllWishListByCustomerAction;
use App\Containers\PromotionCampaign\Actions\FrontEnd\ApplyCampaignForProductListAction;

trait GetAllWishList
{
    public $data = [];
    public function getAllWishList(GetAllWishListRequest $request, ApplyCampaignForProductListAction $applyCampaignForProductListAction)
    {
        // dd($this->user->id);
        $wishList = app(GetAllWishListByCustomerAction::class)->run(
            $this->user->id,
            'favorite',
            [
                'product',
                'product.desc',
                'product.manufacturer',
                'product.specialOffers',
                'product.specialOffers.desc',
                'product.specialTags',
                'product.specialTags.desc'
            ]
        );

        $list_product = $wishList->pluck('product');

        $applyCampaignForProductListAction->run($list_product);

        $wishList = $this->transform($wishList, WishListTransformer::class, [], [], 'wish-List');

        $this->data['wish_list'] = isset($wishList['data']) ? $wishList['data'] : [];
        $this->data['pagination'] = isset($wishList['meta']['pagination']) ? $wishList['meta']['pagination'] : [];

        return $this->data;
    }
}
