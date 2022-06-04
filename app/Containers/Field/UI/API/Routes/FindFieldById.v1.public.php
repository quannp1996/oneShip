<?php

/**
 * @apiGroup           Field
 * @apiName            findFieldById
 *
 * @api                {GET} /v1/fields/:id Endpoint title here..
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
$router->get('fields/{id}', [
    'as' => 'api_field_find_field_by_id',
    'uses'  => 'Controller@findFieldById',
    'middleware' => [
      'auth:api',
    ],
]);
