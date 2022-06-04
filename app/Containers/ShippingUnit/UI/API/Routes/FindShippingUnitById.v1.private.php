<?php

/**
 * @apiGroup           ShippingUnit
 * @apiName            findShippingUnitById
 *
 * @api                {GET} /v1/shippingunits/:id Endpoint title here..
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
$router->get('shippingunits/{id}', [
    'as' => 'api_shippingunit_find_shipping_unit_by_id',
    'uses'  => 'Controller@findShippingUnitById',
    'middleware' => [
      'auth:api',
    ],
]);
