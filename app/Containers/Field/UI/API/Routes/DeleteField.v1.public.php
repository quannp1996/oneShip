<?php

/**
 * @apiGroup           Field
 * @apiName            deleteField
 *
 * @api                {DELETE} /v1/fields/:id Endpoint title here..
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
$router->delete('fields/{id}', [
    'as' => 'api_field_delete_field',
    'uses'  => 'Controller@deleteField',
    'middleware' => [
      'auth:api',
    ],
]);
