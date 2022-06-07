<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-09-07 13:09:51
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-11-16 12:53:49
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\UI\API\Transformers\FrontEnd;

use Apiato\Core\Foundation\ImageURL;
use App\Ship\Parents\Transformers\Transformer;

class OrderItemTransfomer extends Transformer
{

    public function __construct()
    {
    }

    /**
     * @param $token
     *
     * @return  array
     */
    public function transform($item)
    {
        $data = [
            'id' => $item->id,
            'order_id' => $item->order_id,
            'product_id' => $item->product_id,
            'variant_id' => $item->variant_id,
            'variant_parent_id' => $item->variant_parent_id,
            'name' => $item->name,
            'price' => $item->price,
            'global_price' => @$item->product->global_price < $item->price ? 0 : @$item->product->global_price,
            'quantity' => $item->quantity,
            'opts' => json_decode($item->opts),
            'special_offers' => json_decode($item->special_offers),
            'image' => ImageURL::getImageUrl(@$item->product->image, 'product', 'small'),
            'url' => !empty($item->produc) && $item->product->relationLoaded('desc') && isset($item->product->desc->slug) ? route('web_product_detail_page', ['slug' => $item->product->desc->slug, 'id' => $item->product->id]) : '',
        ];

        // if(isset($this->order->orderItems[$item->variant_parent_id])) {
        //     $this->order->orderItems[$item->variant_parent_id]['childs'][] = $data;
        //     return $data;
        // }else {
        //     return $data;
        // }

        return $data;
    }
}
