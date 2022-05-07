<?php

use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::group(['prefix' => '/permissions'], function () {
    SimpleRouter::get('/', function () {
        include "../resource/view/header.php";
        include "../resource/view/action-modal.php";
        include "../resource/view/dashboard/permissions/index.php";
        include "../resource/view/footer.php";
    });

    SimpleRouter::form('/{group_name}', function ($group_name) {
        if (isset($_POST["action"])) {
            if (!urlHelper::validCSRF()) {
                header('Location: ' . urlHelper::get() . "/permissions/" . $group_name . "?action&success=false&message=csrfFailed");
                die();
            }

            if ($_POST["action"] == "groupSettings") {
                urlHelper::buildDefaultRequest("permissions", "PUT", json_encode(array("name" => $_POST["groupName"], "defaultGroup" => isset($_POST["defaultGroup"]), "edit_name" => $_POST["name"], "prefix" => $_POST["prefix"], "display" => $_POST["display"], "color" => $_POST["color"], "suffix" => $_POST["suffix"], "sortId" => $_POST["sortId"])));
                header('Location: ' . urlHelper::get() . "/permissions/" . $group_name . "?action&success=true&message=updatePermissionGroup");
                die();
            }

            if ($_POST["action"] == "deletePermission") {
                urlHelper::buildDefaultRequest("permissions/permission/delete", "POST", json_encode(array("permission" => $_POST["permissionName"], "groupName" => $group_name)));
                header('Location: ' . urlHelper::get() . "/permissions/" . $group_name . "?action&success=true&message=deletePermission");
                die();
            }

            if ($_POST["action"] == "deleteGroup") {
                urlHelper::buildDefaultRequest("permissions/group/delete", "POST", json_encode(array("name" => $_POST["groupName"], "groupName" => $group_name)));
                header('Location: ' . urlHelper::get() . "/permissions/" . $group_name . "?action&success=true&message=deleteGroupFromGroup");
                die();
            }

            if ($_POST["action"] == "addPermission") {
                urlHelper::buildDefaultRequest("permissions/permission/add", "POST", json_encode(array("permission" => $_POST["name"], "groupName" => $group_name)));
                header('Location: ' . urlHelper::get() . "/permissions/" . $group_name . "?action&success=true&message=addPermission");
                die();
            }

        }

        include "../resource/view/header.php";
        include "../resource/view/action-modal.php";
        include "../resource/view/dashboard/permissions/show.php";
        include "../resource/view/footer.php";
    });
});