<?php

/**
 * @apiGroup           ShippingUnit
 * @apiName            deleteShippingUnit
 *
 * @api                {DELETE} /v1/shippingunits/:id Endpoint title here..
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
$router->delete('shippingunits/{id}', [
    'as' => 'api_shippingunit_delete_shipping_unit',
    'uses'  => 'Controller@deleteShippingUnit',
    'middleware' => [
      'auth:api',
    ],
]);
