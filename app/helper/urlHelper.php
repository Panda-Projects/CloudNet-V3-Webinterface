<?php

namespace App\Helper;

use JetBrains\PhpStorm\Pure;

class urlHelper
{

    protected static array $configObj;

    public function __construct($config)
    {
        self::$configObj = $config;
    }

    public static function get($only = "all"): string
    {
        $config = self::$configObj;

        $main = $config['url']['main'];
        $ssl = $config['url']['ssl'];
        $pfad = $config['url']['pfad'];
        $without_sub = $config['url']['without_sub'];

        if ($only == "pfad") {
            return $pfad;
        } elseif ($only == "main") {
            return $main;
        } elseif ($only == "ssl") {
            return $ssl;
        } elseif ($only == "without_sub") {
            return $without_sub;
        } else {
            return $ssl . "" . $main . "" . $pfad;
        }
    }

    #[Pure] public static function provideUrl($subPath): string
    {
        return self::getconfig()['cloudnet']['protocol'] . self::getconfig()['cloudnet']['ip'] . ":" . self::getconfig()['cloudnet']['port'] . self::getconfig()['cloudnet']['path'] . "/$subPath";
    }

    public static function getConfig(): array
    {
        return self::$configObj;
    }

    public static function validCSRF(): bool
    {
        return isset($_POST['csrf']) ?? false and $_POST['csrf'] == $_SESSION['csrf_token'];
    }

    public static function buildDefaultRequest($url, $method = "GET", $params = array(), $debug = false): mixed
    {
        return self::buildRequest($url, $_SESSION['cn3-wi-access_token'], $method, $params, $debug);
    }

    public static function buildRequest($url, $token, $method = "POST", $params = array(), $debug = false): mixed
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => self::provideUrl($url),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 1,
            CURLOPT_TIMEOUT => 5,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $params,
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Authorization: Basic ' . $token,
                'Cookie: ' . $_SESSION["cn3-wi-cookie"]
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        if ($response === FALSE) {
            return array("success" => "false");
        }

        if ($debug == true) {
            return $response;
        } else {
            return json_decode($response, true);
        }
    }

}