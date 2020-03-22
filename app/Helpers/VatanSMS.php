<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 22.03.2020
 * Time: 22:40
 */

namespace App\Helpers;


class VatanSMS
{
    public static function send($phone, $message)
    {
        header('Content-Type: text/html; charset=utf-8');
        $postUrl='http://panel.vatansms.com/panel/smsgonder1Npost.php';
        $MUSTERİNO='36980'; //5 haneli müşteri numarası
        $KULLANICIADI='05348889800';
        $SIFRE='93SXP8GD';
        $ORGINATOR="KAFABILISIM";

        $TUR='Normal';  // Normal yada Turkce

        //$mesaj1='KAFAKAFAYA SMS KODU '. $code . '.';
        //$numara1='5318282332';

        $xmlString='data=<sms>
<kno>'. $MUSTERİNO .'</kno>
<kulad>'. $KULLANICIADI .'</kulad>
<sifre>'.$SIFRE .'</sifre>
<gonderen>'.  $ORGINATOR .'</gonderen>
<mesaj>'. $message .'</mesaj>
<numaralar>'. $phone.'</numaralar>
<tur>'. $TUR .'</tur>
</sms>';

// Xml içinde aşağıdaki alanlarıda gönderebilirsiniz.
//<zaman>'. $ZAMAN.'</zaman> İleri tarih için kullanabilirsiniz

        $Veriler =  $xmlString;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $postUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $Veriler);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $response = curl_exec($ch);
        curl_close($ch);

        //echo $response;
        $pos = strpos($response, '1:');
        if ($pos == 0) return true;
        else return false;
    }
}