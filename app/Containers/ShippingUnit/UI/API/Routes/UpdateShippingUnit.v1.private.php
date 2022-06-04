<?php

/**
 * @apiGroup           ShippingUnit
 * @apiName            updateShippingUnit
 *
 * @api                {PATCH} /v1/shippingunits/:id Endpoint title here..
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  parameters here..
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

/** @var Route $router */
$router->patch('shippingunits/{id}', [
    'as' => 'api_shippingunit_update_shipping_unit',
    'uses'  => 'Controller@updateShippingUnit',
    'middleware' => [
      'auth:api',
    ],
]);
