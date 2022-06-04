<?php

/**
 * @apiGroup           Contact
 * @apiName            updateContact
 *
 * @api                {PATCH} /v1/contacts/:id Endpoint title here..
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
$router->patch('contacts/{id}', [
    'as' => 'api_contact_update_contact',
    'uses'  => 'Controller@updateContact',
    'middleware' => [
      'auth:api',
    ],
]);
