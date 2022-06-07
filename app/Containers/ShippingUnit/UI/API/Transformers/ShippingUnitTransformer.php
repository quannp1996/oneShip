<?php

namespace App\Containers\ShippingUnit\UI\API\Transformers;

use App\Containers\ShippingUnit\Models\ShippingUnit;
use App\Ship\Parents\Transformers\Transformer;

class ShippingUnitTransformer extends Transformer
{
    /**
     * @var  array
     */
    protected $defaultIncludes = [

    ];

    /**
     * @var  array
     */
    protected $availableIncludes = [

    ];

    /**
     * @param ShippingUnit $entity
     *
     * @return array
     */
    public function transform(ShippingUnit $entity)
    {
        $response = [
            'object' => 'ShippingUnit',
            'id' => $entity->getHashedKey(),
            'created_at' => $entity->created_at,
            'updated_at' => $entity->updated_at,

        ];

        $response = $this->ifAdmin([
            'real_id'    => $entity->id,
            // 'deleted_at' => $entity->deleted_at,
        ], $response);

        return $response;
    }
}
