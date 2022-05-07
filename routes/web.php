<?php

use App\Helper\urlHelper;
use App\Http\Controller\authorizeController;
use App\Http\Middleware\AuthMiddleware;
use Pecee\SimpleRouter\SimpleRouter;

$urlhelper = new urlHelper($config);

if (isset($_SESSION['cn3-wi-access_token'])) {
    SimpleRouter::group([], function () {
        SimpleRouter::get('/', function () {
            include "../resource/view/header.php";
            include "../resource/view/action-modal.php";
            include "../resource/view/dashboard/dashboard.php";
            include "../resource/view/footer.php";
        });

        include 'route/tasks.php';
        include 'route/players.php';
        include 'route/permissions.php';

        SimpleRouter::group(['prefix' => '/modules'], function () {
            SimpleRouter::get('/', function () {
                include "../resource/view/header.php";
                include "../resource/view/action-modal.php";
                include "../resource/view/dashboard/modules/index.php";
                include "../resource/view/footer.php";
            });
        });

        SimpleRouter::group(['prefix' => '/groups'], function () {
            SimpleRouter::form('/', function () {
                if (isset($_POST['action'])) {
                    if (!main::validCSRF()) {
                        header('Location: ' . urlHelper::get() . "/cluster?action&success=false&message=csrfFailed");
                        die();
                    }

                    if ($_POST["action"] == "createGroup") {
                        $response = urlHelper::buildDefaultRequest("groups", "POST");
                    }
                }

                include "../resource/view/header.php";
                include "../resource/view/action-modal.php";
                include "../resource/view/dashboard/groups/index.php";
                include "../resource/view/footer.php";
            });
        });

        SimpleRouter::group(['prefix' => '/cluster'], function () {
            SimpleRouter::get('/', function () {
                include "../resource/view/header.php";
                include "../resource/view/action-modal.php";
                include "../resource/view/dashboard/cluster/index.php";
                include "../resource/view/footer.php";
            });
        });

        SimpleRouter::get('/logout', function () {
            urlHelper::buildDefaultRequest("session/logout");
            unset($_SESSION['cn3-wi-access_token']);
            header('Location: ' . urlHelper::get());
            die();
        });
    });

} else {

    SimpleRouter::form('/', function () {
        if (isset($_POST['action'])) {
            if (!urlHelper::validCSRF()) {
                header('Location: ' . urlHelper::get() . "/?action&success=false&message=csrfFailed");
                die();
            }

            if ($_POST['action'] == "login" and isset($_POST['username']) and isset($_POST['password'])) {
                $action = authorizeController::login($_POST['username'], $_POST['password']);
                if ($action == LOGIN_RESULT_SUCCESS) {
                    header('Location: ' . urlHelper::get());
                } else {
                    header('Location: ' . urlHelper::get() . "/login?action&success=false&message=loginFailed");
                }
                die();
            }
        }

        include "../resource/view/small-header.php";
        include "../resource/view/action-modal.php";
        include "../resource/view/login.php";
        include "../resource/view/footer.php";
    })->name('login');

}