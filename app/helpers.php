<?php

use App\Models\Settings;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;

function displayCash($cash)
{
    $lang = App::getLocale();
    
    switch ($lang) {
        case 'vi':
            $currency = "₫";

            if ($cash == "currency") {
                return $currency;
            }

            break;
        
        case 'en':
            $currency = "$";
            
            if ($cash == "currency") {
                return $currency;
            }

            return $currency."".number_format($cash);
            break;

        default:
            $currency = "";
            break;
    }

    return number_format($cash).$currency; // common
}

function setting($name)
{
    return Settings::where('name', $name)->first()['value'] ?? "Unknown";
}

function displayRole($role)
{
    // $role_array = array(
    //     0 => "member",
    //     1 => "admin"
    // );

    // if (array_key_exists($role, $role_array)) {
    //     return __("system.".$role_array[$role]."_role");
    // } else {
    //     return "Unknown Role";
    // }

    $role_array = ['member', 'admin'];

    if (in_array($role, $role_array)) {
        return __("system.".$role."_role");
    } else {
        return "Unknown Role";
    }
}

function validCaptcha($response, $ip) {
    $query = http_build_query([
        "secret" => setting('captcha_v2_secret'),
        "response" => $response,
        "remoteip" => $ip
    ]);
    $curl = Http::get("https://www.google.com/recaptcha/api/siteverify?".$query);
    $body = $curl->body();

    return json_decode($body, true)['success'];
}

function exchangeRate($curr) {
    $rate = array(
        "usd_vnd" => 23000,
        "vnd_usd" => 0.000044
    );

    return $rate[$curr] ?? false;
}

function convertPriceCurrency($price, $curr) {
    $rate = exchangeRate($curr);
    
    $convert = array(
        "usd_vnd" => round($price * $rate),
        "vnd_usd" => round($price * $rate),
    );

    return $convert[$curr] ?? false;
}

function update_env( $data = [] ) : void {  

    $path = base_path('.env');

    if (file_exists($path)) {
        foreach ($data as $key => $value) {
            file_put_contents($path, str_replace(
                $key . '=' . env($key), $key . '=' . $value, file_get_contents($path)
            ));
        }
    }

}