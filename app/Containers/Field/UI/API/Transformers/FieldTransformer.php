<?php

namespace App\Containers\Field\UI\API\Transformers;

use App\Containers\Field\Models\Field;
use App\Ship\Parents\Transformers\Transformer;

class FieldTransformer extends Transformer
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
     * @param Field $entity
     *
     * @return array
     */
    public function transform(Field $entity)
    {
        $response = [
            'object' => 'Field',
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
