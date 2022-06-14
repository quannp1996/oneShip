<?php

namespace App\Containers\ShippingUnit\UI\API\Transformers;

use App\Containers\ShippingUnit\Models\ShippingConst;
use App\Containers\ShippingUnit\Models\ShippingUnit;
use App\Ship\Parents\Transformers\Transformer;

class ShippingConstTransformer extends Transformer
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
    public function transform(ShippingConst $entity)
    {
        $response = [
            'id' => $entity->id,
            'items' => $entity->items,
            'title' => $entity->title,
            'created_at' => $entity->created_at,
            'updated_at' => $entity->updated_at,
        ];
        return $response;
    }
}
