<?php

/**
 * @apiGroup           Field
 * @apiName            createField
 *
 * @api                {POST} /v1/fields Endpoint title here..
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
$router->post('fields', [
    'as' => 'api_field_create_field',
    'uses'  => 'Controller@createField',
    'middleware' => [
      'auth:api',
    ],
]);
