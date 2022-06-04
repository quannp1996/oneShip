<?php

/**
 * @apiGroup           Contact
 * @apiName            getAllContacts
 *
 * @api                {GET} /v1/contacts Endpoint title here..
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
$router->get('contacts', [
    'as' => 'api_contact_get_all_contacts',
    'uses'  => 'Controller@getAllContacts',
]);
