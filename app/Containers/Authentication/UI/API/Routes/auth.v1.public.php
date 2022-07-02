<?php
/**
 * @apiGroup           OAuth2
 * @apiName            Logout
 * @api                {DELETE} /v1/logout Logout
 * @apiDescription     User Logout. (Revoking Access Token)
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 202 Accepted
{
  "message": "Token revoked successfully."
}
 */
$router->post('/social/login', [
    'as' => 'api_authentication_login',
    'uses'  => 'Controller@loginSocial',
]);


$router->post('/register/post', [
  'as' => 'api_authentication_register_post',
  'uses'  => 'Controller@register',
]);
