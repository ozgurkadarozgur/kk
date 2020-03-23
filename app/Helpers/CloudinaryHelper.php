<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 24.03.2020
 * Time: 00:03
 */

namespace App\Helpers;


use JD\Cloudder\Facades\Cloudder;

class CloudinaryHelper
{
    public static function upload_image($file, $folder = 'assets')
    {
        Cloudder::upload($file, null, [
            'folder' => $folder,
        ]);
        return Cloudder::getResult();
    }
}