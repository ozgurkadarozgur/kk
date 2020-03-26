<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 08.03.2020
 * Time: 19:20
 */

namespace App\Helpers;


class PayfullHelper
{

    public const PROCESS_TYPE_VS_INVITED_ACCEPT = 'vs_invited_accept';
    public const PROCESS_TYPE_VS_INVITER_ACCEPT = 'vs_inviter_accept';
    public const PROCESS_TYPE_ELIMINATION_APPLICATION = 'elimination_application';
    public const PROCESS_TYPE_LEAGUE_APPLICATION = 'league_application';
    public const PROCESS_TYPE_ASTROTURF_RESERVATION = 'astroturf_reservation';
    public const PROCESS_TYPE_E_COMMERCE_BUY_PRODUCT= 'e_commerce_buy_product';

    private static $ERR_CODE_ARR = [
        '00' => 'Ödeme işlemi başarılı.',
        '03' => 'Yanlış müşteri adı.',
        '08' => 'Yanlış kredi kartı numarası.',
        '09' => 'Yanlış CVC numarası.'
    ];

    public static function request($apiUser, array $card, $price, $meta)
    {

        //API isteğini göndereceğiniz Endpoint URL değeri
        $api_url = 'https://kafakafaya.payfull.com/integration/api/v1';

        //Payfull hesabınız içerisinde oluştuduğunuz API hesabına ait "Üye İşyeri Şifresi" değeri.
        //$merchantPassword = 'KkPi756*!-';
        $merchantPassword = 'DvPas1622*?';

        $message = '';
        $data=[
            "merchant"=>"dev_api",
            "type"=>"Sale",
            "use3d"=>"1",
            //"return_url"=>"http://admin.kk.app-xr.com/payment-response",
            "return_url"=> route('payment.payfull.handle_response'),
            "total"=> $price,
            "cc_name"=> $card['holderName'],
            "cc_number"=> $card['cardNumber'],
            "cc_month"=> $card['expireMonth'],
            "cc_year"=> $card['expireYear'],
            "cc_cvc"=> $card['cvc'],
            "currency"=>"TRY",
            "installments"=>"1",
            "language"=>"tr",
            "client_ip"=>"192.168.1.1",
            "payment_title"=>"just payemnt title",
            "customer_firstname"=> $apiUser->full_name,
            "customer_lastname"=> $apiUser->full_name,
            "customer_email"=> $apiUser->email,
            "customer_phone"=> $apiUser->phone,
//"customer_tc"=>"12590326514",
            "passive_data"=> $meta,
        ];
        $arr=[];
        foreach($data as $param_key=>$param_val){$arr[strtolower($param_key)]=$param_val;}
        ksort($arr);
        foreach($arr as $key=>$value) {
            $message .= mb_strlen((string)$value) . $value;
        }
        $hash = strtolower(hash_hmac('sha256',  $message, "DvPas1622*?"));
        //echo $hash;
        $data['hash'] = $hash;

        //curl sürecini başlatıyoruz.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        //curl için gerekli olan URL değeri ve parametreler hazırlandı ve curl_exec() fonksiyonu ile işlemi başlatıp cevabı $response değerine atıyoruz.
        $response = curl_exec($ch);
        //dd($response);
        $curlerrcode = curl_errno($ch);

        $curlerr = curl_error($ch);

        //cevabı öğrenmek için print ediyoruz.
        //var_dump(json_decode($response));

        $is_json = json_decode($response);

        if ($is_json == null) {
            //hata yok
            return (object)[
                'status' => true,
                'data' => $response,
            ];
        } else {
            //hata var
            return (object)[
                'status' => false,
                'data' => $response,
            ];
        }

    }

    public static function get_message($data)
    {
        $err_code = $data["ErrorCode"];
        $msg = null;
        try {
            $msg = self::$ERR_CODE_ARR[$err_code];
        } catch (\Exception $ex) {
            $msg = 'Bir hata oluşu. Lütfen bilgilerinizi kontrol edip tekrar deneyin.';
        }
        return $msg;
    }
}