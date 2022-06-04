<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-20 03:00:38
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-19 16:06:16
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\UI\API\Transformers\FrontEnd\DeliveryAndPayment;

use App\Containers\Settings\Models\DeliveryType;
use App\Containers\Settings\Models\Setting;
use App\Ship\Parents\Transformers\Transformer;

class DeliveryMethodsTransfomer extends Transformer
{
    /**
     * @var  array
     */
    protected array $defaultIncludes = [
    ];

    /**
     * @var  array
     */
    protected array $availableIncludes = [
    ];

    /**
     * @param Setting $entity
     * @return array
     */
    public function transform(DeliveryType $entity)
    {
        $response = [
            'id' => $entity->id,
            'sort_order' => $entity->sort_order,
            'name' => $entity->desc->name,
            'short_description' => $entity->desc->short_description,
            'shipping_fee' => $entity->shipping_fee,
            'min_order_free_ship' => $entity->min_order_free_ship,
            'selected' => false
        ];

        return $response;
    }
}
