<?php

use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::group(['prefix' => '/players'], function () {
    SimpleRouter::get('/', function () {
        include "../resource/view/header.php";
        include "../resource/view/action-modal.php";
        include "../resource/view/dashboard/players/index.php";
        include "../resource/view/footer.php";
    });

    SimpleRouter::form('/{player}', function ($uuid) {
        if (isset($_POST["action"])) {
            if (!urlHelper::validCSRF()) {
                header('Location: ' . urlHelper::get() . "/players/" . $uuid . "?action&success=false&message=csrfFailed");
                die();
            }

            if ($_POST["action"] == "addGroup") {
                urlHelper::buildDefaultRequest("players/" . $uuid . "/add", 'PUT', json_encode(array("group" => $_POST["permissionGroup"], "time" => $_POST["time"], "time_number" => $_POST["time_number"])));
                header('Location: ' . urlHelper::get() . "/players/" . $uuid . "?action&success=true&message=addGroupToPlayer");
                die();
            }

            if ($_POST["action"] == "deleteGroup") {
                urlHelper::buildDefaultRequest("players/" . $uuid . "/remove", 'PUT', json_encode(array("group" => $_POST["groupName"])));
                header('Location: ' . urlHelper::get() . "/players/" . $uuid . "?action&success=true&message=deleteGroupFromPlayer");
                die();
            }

            if ($_POST["action"] == "addPermission") {
                urlHelper::buildDefaultRequest("players/" . $uuid . "/add", 'PUT', $_POST["serviceGroup"] == "all" ?
                    json_encode(array("permission" => $_POST["permission"])) :
                    json_encode(array("permission" => $_POST["permission"], "serviceGroup" => $_POST["serviceGroup"])));
                header('Location: ' . urlHelper::get() . "/players/" . $uuid . "?action&success=true&message=addPermissionFromPlayer");
                die();
            }

            if ($_POST["action"] == "deletePermission") {
                urlHelper::buildDefaultRequest("players/" . $uuid . "/remove", 'PUT', json_encode(array("permission" => $_POST["permission"])));
                header('Location: ' . urlHelper::get() . "/players/" . $uuid . "?action&success=true&message=deletePermissionFromPlayer");
                die();
            }
        }

        include "../resource/view/header.php";
        include "../resource/view/action-modal.php";
        include "../resource/view/dashboard/players/show.php";
        include "../resource/view/footer.php";
    });
});