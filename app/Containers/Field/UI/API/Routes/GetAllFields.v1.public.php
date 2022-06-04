<?php

/**
 * @apiGroup           Field
 * @apiName            getAllFields
 *
 * @api                {GET} /v1/fields Endpoint title here..
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
$router->get('fields', [
    'as' => 'api_field_get_all_fields',
    'uses'  => 'Controller@getAllFields',
    'middleware' => [
      'auth:api',
    ],
]);
