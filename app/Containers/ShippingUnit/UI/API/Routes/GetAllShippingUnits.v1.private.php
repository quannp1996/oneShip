<?php

/**
 * @apiGroup           ShippingUnit
 * @apiName            getAllShippingUnits
 *
 * @api                {GET} /v1/shippingunits Endpoint title here..
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
$router->get('shippingunits', [
    'as' => 'api_shippingunit_get_all_shipping_units',
    'uses'  => 'Controller@getAllShippingUnits',
]);
