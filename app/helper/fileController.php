<?php

namespace App\Helper;

define('BASE_PATH', __DIR__ . DIRECTORY_SEPARATOR);

class fileController
{
    protected static string $path_config = BASE_PATH . '../../config/config.php';
    protected static string $path_version = BASE_PATH . '../../config/version.php';
    protected static string $path_message = BASE_PATH . '../../config/messages.json';

    public static function dieWhenFileMissing()
    {
        if (!file_exists(self::$path_config)) {
            if (isset($_POST['action'])) {
                if ($_POST["action"] == "setup") {
                    $myfile = fopen("../config/config.php", "w") or die("Unable to open file!");
                    $txt = '<?php
$config = array(
    "url" => array(
        "main" => "' . $_POST["website_ip"] . '",
        "ssl" => "' . $_POST["website_protocol"] . '",
        "pfad" => "' . $_POST["website_path"] . '",
        "without_sub" => "' . $_POST["website_ip"] . '",
        "force" => "true",
    ),
    "cloudnet" => array(
        "protocol" => "' . $_POST["cloudnet_protocol"] . '",
        "ip" => "' . $_POST["cloudnet_ip"] . '",
        "port" => "' . $_POST["cloudnet_prot"] . '",
        "path" => "' . $_POST["cloudnet_apipath"] . '",
    ),
    "name" => "' . $_POST["website_name"] . '",
);';
                    fwrite($myfile, $txt);
                    fclose($myfile);
                    header('Location: ' . $_POST["website_protocol"] . $_POST["website_ip"]);
                }
            }

            include BASE_PATH . '../../resource/view/setup/small-header.php';
            include BASE_PATH . '../../resource/view/setup/setup.php';
            include BASE_PATH . '../../resource/view/footer.php';
            die("");
        }

        if (!file_exists(self::$path_version)) {
            die('<h1><span style="color: #FF0000">Ein Fehler ist aufgetreten.</span></h1><h3>Die Datei "/config/version.php" konnte nicht gefunden werden</h3><h3>Führe das Setup mit "wisetup" im Master erneut aus!</h3>');
        }

        if (!file_exists(self::$path_message)) {
            die('<h1><span style="color: #FF0000">Ein Fehler ist aufgetreten.</span></h1><h3>Die Datei "/config/message.json" konnte nicht gefunden werden</h3><h3>Führe das Setup mit "wisetup" im Master erneut aus!</h3>');
        }
    }

    public static function getConfigurationPath(): string
    {
        return self::$path_config;
    }

    public static function getVersionFilePath(): string
    {
        return self::$path_version;
    }
}