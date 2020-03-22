<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 07.03.2020
 * Time: 16:21
 */

namespace App\Helpers;

use GuzzleHttp\Client;
use \Symfony\Component\HttpFoundation\Request as mRequest;

class OAuthHelper
{
    public static function get_access_token($username, $password)
    {

        $guzzle = new Client();

        $url = 'http://api.'. env('APP_MAIN_URL') .'/oauth/token';

        try {
            $response = $guzzle->post($url, [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => '2',
                    'client_secret' => env('OAUTH_CLIENT_SECRET'),
                    'username' => $username,
                    'password' => $password,
                    'scope' => '*',
                ],
            ]);
            return json_decode((string) $response->getBody(), true)['access_token'];
        } catch (\Exception $ex) {
            //if (env('APP_DEBUG')) dd($ex);
            return null;
        }


        //return json_decode((string) $response->getBody(), true)['access_token'];


        /*
        $mRequest = mRequest::create('oauth/token', 'POST', [
            'grant_type' => 'password',
            'client_id' => 2,
            'client_secret' => env('OAUTH_CLIENT_SECRET'),
            'username' => $username,
            'password' => $password
        ]);
        $response = app()->handle($mRequest);
        return $response;
        */
    }
}