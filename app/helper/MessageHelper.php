<?php

namespace App\Helper;

class MessageHelper
{
    public static function getMessage($key)
    {
        $file = BASE_PATH . '../../config/messages.json';
        $json = file_get_contents($file);
        $message = json_decode($json, true);
        return $message[$key] ?? $key;
    }
}