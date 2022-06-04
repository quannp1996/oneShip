<?php

/**
 * @apiGroup           Field
 * @apiName            updateField
 *
 * @api                {PATCH} /v1/fields/:id Endpoint title here..
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
$router->patch('fields/{id}', [
    'as' => 'api_field_update_field',
    'uses'  => 'Controller@updateField',
    'middleware' => [
      'auth:api',
    ],
]);
