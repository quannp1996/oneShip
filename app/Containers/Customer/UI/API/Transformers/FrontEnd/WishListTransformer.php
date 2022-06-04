<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-18 15:28:43
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-18 15:35:19
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\UI\API\Transformers\FrontEnd;

use App\Ship\Parents\Transformers\Transformer;
use App\Containers\Product\UI\API\Transformers\FrontEnd\ProductListTransformer;
use Apiato\Core\Foundation\Facades\ImageURL;
use Apiato\Core\Foundation\FunctionLib;

class WishListTransformer extends Transformer
{
    protected array $availableIncludes = [];

    protected array $defaultIncludes = [];

    public function transform($wishList)
    {
        $prd=$wishList->product;
        $response = [
            "product_id" => @$prd->id,
            "name" => @$prd->desc->name,
            "slug" => @$prd->desc->slug,
            "product_url" => routeFrontEndFromOthers('web.product.detail',['slug' => @$prd->desc->slug ? $prd->desc->slug : 'xxxx','id' => $prd->id]),
            "product_image" => ImageURL::getImageUrl($prd->image,'product','mediumx2'),
            "product_image_medium" => ImageURL::getImageUrl($prd->image,'product','mediumx2'),
            "product_image_small" => ImageURL::getImageUrl($prd->image,'product','small'),
            "brand" => "",
            "status" => $prd->status,
            "price" => $prd->price,
            "price_formated" => FunctionLib::numberFormat($prd->price),
            "old_price" => $prd->global_price,
            "old_price_formated" => FunctionLib::numberFormat($prd->global_price),
            "discount" => 100 - (@$prd->price > 0 && @$prd->global_price > 0 ? round($prd->price/$prd->global_price*100) : 100) ,
            "is_hot" => $prd->hot ? true : false,
            "is_home" => $prd->is_home ? true : false,
            "is_new" => $prd->is_new ? true : false,
            "is_top_search" => $prd->is_top_searching ? true : false,
            "is_freeship" => $prd->shipping_required ? false : true,
            'is_quick' => $prd->is_quick ? true : false,
            "total_sold" => FunctionLib::numberFormat((int)@$prd->purchased_count),
            "special_offer" => $prd->relationLoaded('specialOffers') ? $prd->specialOffers->pluck('desc')->toArray() : [],
            "special_tags" => [
                [
                    "img" => "/template/images/ic-tro-gia.png",
                    "name" => "Trả góp",
                    "bgColor" => "#f34343",
                    "specialType" => false
                ]
            ],
            "rating" => $prd->avg_rating,
            'is_wish_list'=>$prd->wishList()->count()>0?true:false
        ];

        return $response;
    }
}
