<?php

namespace App\Containers\ShippingUnit\UI\WEB\Transformers;

use App\Containers\ShippingUnit\Models\ShippingUnit;
use App\Ship\Parents\Transformers\Transformer;

class ShippingFeesTransformer extends Transformer
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
     * @param ShippingUnit $entity
     *
     * @return array
     */
    public function transform(ShippingUnit $entity)
    {
        $response = [
            'image' => $entity->getImageUrl(),
            'title' => $entity->title,
            'time_pickup' => $entity->time,
            'fee' => !empty($entity->fee) ? $entity->fee : 0,
        ];
        return $response;
    }
}
