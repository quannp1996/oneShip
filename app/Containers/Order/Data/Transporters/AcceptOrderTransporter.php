<?php

namespace App\Containers\Order\Data\Transporters;

use App\Ship\Parents\Transporters\Transporter;

class AcceptOrderTransporter extends Transporter
{

    /**
     * @var array
     */
    protected $schema = [
        'type' => 'object',
        'properties' => [
          'id' => ['type' => 'string'],
          'additionalProperties' => false,


            // enter all properties here

            // allow for undefined properties
            // 'additionalProperties' => true,
        ],
        'required'   => [
            // define the properties that MUST be set
            'id'
        ],
        'default'    => [
            // provide default values for specific properties here
        ],
    ];
}
