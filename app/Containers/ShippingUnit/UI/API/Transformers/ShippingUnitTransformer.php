<?php

namespace App\Containers\ShippingUnit\UI\API\Transformers;

use App\Containers\ShippingUnit\Models\ShippingUnit;
use App\Ship\Parents\Transformers\Transformer;

class ShippingUnitTransformer extends Transformer
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
            'id' => $entity->id,
            'image' => $entity->getImageUrl(),
            'title' => $entity->title,
            'created_at' => $entity->created_at,
            'updated_at' => $entity->updated_at,
        ];

        $response = $this->ifAdmin([
            'real_id'    => $entity->id,
        ], $response);

        return $response;
    }
}
