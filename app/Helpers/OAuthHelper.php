<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 07.03.2020
 * Time: 16:21
 */

namespace App\Helpers;

use \Symfony\Component\HttpFoundation\Request as mRequest;

class OAuthHelper
{
    public static function get_access_token($username, $password)
    {
        $mRequest = mRequest::create('oauth/token', 'POST', [
            'grant_type' => 'password',
            'client_id' => 2,
            'client_secret' => env('OAUTH_CLIENT_SECRET'),
            'username' => $username,
            'password' => $password
        ]);
        $response = app()->handle($mRequest);
        return $response;
    }
}