<?php

namespace App\Http\Controller;

use App\Helper\urlHelper;

/**
 * The result returned when the login request successfully finished.
 */
define('LOGIN_RESULT_SUCCESS', 0);

/**
 * The result returned when the provided http server in the configuration
 * is currently not reachable.
 */
define('LOGIN_RESULT_SERVER_DOWN', 1);

/**
 * The result returned when invalid credentials were submitted to the login
 * function and the server did not accept the result.
 */
define('LOGIN_RESULT_INVALID_CREDENTIALS', 2);

class authorizeController
{

    /**
     * Posts a login request to the configured cloudnet rest endpoint.
     *
     * @param $username string the username to use.
     * @param $password string the password associated to the provided user.
     * @return int the status of the login.
     */

    public static function login(string $username, string $password): int
    {
        $url = urlHelper::provideUrl("auth");
        $token = base64_encode("$username:$password");
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic ' . $token
            ),
        ));

        $response = curl_exec($curl);
        $responseHttpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);
        if ($response === FALSE || $responseHttpCode !== 200) {
            return LOGIN_RESULT_SERVER_DOWN;
        }

        $response = json_decode($response, true);
        if ($response['success'] == true) {
            // session_start();
            $_SESSION['cn3-wi-access_token'] = $token;
            $_SESSION['cn3-wi-cookie'] = $response["cookie"];
            $_SESSION['cn3-wi-user'] = $response["userUniqueId"];

            return LOGIN_RESULT_SUCCESS;
        } else {
            return LOGIN_RESULT_INVALID_CREDENTIALS;
        }
    }

    public static function loginToken(string $token): int
    {
        $url = urlHelper::provideUrl("auth");

        $curl = curl_init($url);
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 1,
            CURLOPT_TIMEOUT => 5,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Authorization: Basic ' . $token
            ),
        ));

        $response = curl_exec($curl);
        $responseHttpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        if ($response === FALSE || $responseHttpCode !== 200) {
            return LOGIN_RESULT_SERVER_DOWN;
        }

        $response = json_decode($response, true);
        if ($response['success'] == true) {
            // session_start();
            $_SESSION['cn3-wi-access_token'] = $token;
            return LOGIN_RESULT_SUCCESS;
        } else {
            return LOGIN_RESULT_INVALID_CREDENTIALS;
        }
    }
}
