<?php

use App\Helper\jsonObjectCreator;
use App\Helper\urlHelper;
use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::group(['prefix' => '/tasks'], function () {
    SimpleRouter::form('/', function () {
        if (isset($_POST['action'])) {
            if (!urlHelper::validCSRF()) {
                header('Location: ' . urlHelper::get() . "/cluster?action&success=false&message=csrfFailed");
                die();
            }

            if ($_POST['action'] == "createTask" and isset($_POST['name'])) {
                // validate that all required values are there
                $name = $_POST['name'];
                $ram = $_POST['ram'];
                $env = $_POST['environment'];
                $node = $_POST['node'];
                $startPort = $_POST['port'];
                $static = $_POST['static'];
                $autoDeleteOnStop = $_POST['auto_delete_on_stop'];
                $maintenance = $_POST['maintenance'];

                if (isset($name, $ram, $env, $node, $startPort)) {
                    $taskData = jsonObjectCreator::createServiceTaskObject(
                        $name, $ram, $env,
                        $node === "all" ? array() : array($node),
                        $startPort, isset($static), isset($autoDeleteOnStop), isset($maintenance)
                    );
                    $response = urlHelper::buildDefaultRequest("tasks", "POST", params: $taskData);

                    header('Location: ' . urlHelper::get() . "/tasks?action&success=true&message=taskCreated");
                    die();
                }
            }
        }

        include "../resource/view/header.php";
        include "../resource/view/action-modal.php";
        include "../resource/view/dashboard/task/index.php";
        include "../resource/view/footer.php";
    });

    SimpleRouter::form('/{name}', function ($task_name) {
        $task = urlHelper::buildDefaultRequest("tasks/" . strtolower($task_name), "GET", array(), array());
        if (empty($task)) {
            header('Location: ' . urlHelper::get() . "/tasks?action&success=false&message=notFoundTask");
            die();
        }

        $services_r = urlHelper::buildDefaultRequest("services", "GET", array(), array());
        $services = array();
        foreach ($services_r as $service) {
            if (strtolower($service['configuration']['serviceId']['taskName']) == strtolower($task_name)) {
                array_push($services, $service);
            }
        }

        if (isset($_POST['action'])) {
            if (!urlHelper::validCSRF()) {
                header('Location: ' . urlHelper::get() . "/tasks/" . $task_name . "?action&success=false&message=csrfFailed");
                die();
            }

            if ($_POST['action'] == "stopService" and isset($_POST['service_id'])) {
                $response = urlHelper::buildDefaultRequest("services/" . $_POST['service_id'] . "/stop", "GET");
                header('Location: ' . urlHelper::get() . "/tasks/" . $task_name . "?action&success=true&message=stopService");
                die();
            }

            if ($_POST['action'] == "createService" and isset($_POST['count'])) {
                urlHelper::buildDefaultRequest("services/" . strtolower($task_name) . "/" . $_POST['count'] . "/" . (isset($_POST['start']) ? "true" : "false"), "GET");
                header('Location: ' . urlHelper::get() . "/tasks/" . $task_name . "?action&success=true&message=createService");
                die();
            }

            if ($_POST['action'] == "startService" and isset($_POST['service_id'])) {
                urlHelper::buildDefaultRequest("services/" . $_POST['service_id'] . '/start', "GET");

                header('Location: ' . urlHelper::get() . "/tasks/" . $task_name . "?action&success=true&message=startService");
                die();
            }
        }

        include "../resource/view/header.php";
        include "../resource/view/action-modal.php";
        include "../resource/view/dashboard/task/task.php";
        include "../resource/view/footer.php";
    });

    SimpleRouter::get('/{name}/delete', function ($task_name) {
        $task = urlHelper::buildDefaultRequest("tasks/" . strtolower($task_name), "DELETE", array(), array());
        header('Location: ' . urlHelper::get() . "/tasks?action&success=true&message=taskDelete");
        die();
    });

    SimpleRouter::form('/{name}/edit', function ($task_name) {
        $task = urlHelper::buildDefaultRequest("tasks/" . strtolower($task_name), "GET", array(), array());
        if (empty($task)) {
            header('Location: ' . urlHelper::get() . "/tasks?action&success=false&message=notFound");
            die();
        }

        if (isset($_POST['action'])) {
            if (!urlHelper::validCSRF()) {
                header('Location: ' . urlHelper::get() . "/tasks/" . $task_name . "?action&success=false&message=csrfFailed");
                die();
            }
            // FUNCTIONS
            if ($_POST['action'] == "editTask") {
                $name = $_POST['name'];
                $ram = $_POST['memory'];
                $env = $_POST['environment'];
                if (isset($_POST['node'])) {
                    $node = $_POST['node'];
                } else {
                    $node = array();
                }
                if (isset($_POST['group'])) {
                    $group = $_POST['group'];
                } else {
                    $group = array();
                }

                $startPort = $_POST['port'];
                $static = $_POST['static'];
                $autoDeleteOnStop = $_POST['auto_delete_on_stop'];
                $maintenance = $_POST['maintenance'];

                if (isset($name, $ram, $env, $node, $startPort)) {
                    $taskData = jsonObjectCreator::createServiceTaskObject(
                        $name, $ram, $env, $node,
                        $startPort, isset($static), isset($autoDeleteOnStop), isset($maintenance), $group
                    );
                    urlHelper::buildDefaultRequest("tasks", "POST", $taskData);
                    header('Location: ' . urlHelper::get() . "/tasks/" . $task_name . "/edit?action&success=true");
                    die();
                } else {
                    header('Location: ' . urlHelper::get() . "/tasks/" . $task_name . "/edit?action&success=false&message=errorTask");
                }
            }
        }
        include "../resource/view/header.php";
        include "../resource/view/action-modal.php";
        include "../resource/view/dashboard/task/edit.php";
        include "../resource/view/footer.php";
    });

    SimpleRouter::form('/{task_name}/{service_name}/console', function ($task_name, $service_name) {
        $service = urlHelper::buildDefaultRequest("services/" . strtolower($service_name), "GET");
        if (empty($service)) {
            header('Location: ' . urlHelper::get() . "/tasks?action&success=false&message=notFound");
            die();
        }

        if (isset($_POST['action'])) {
            if (!urlHelper::validCSRF()) {
                header('Location: ' . urlHelper::get() . "/tasks/" . $task_name . "/console?action&success=false&message=csrfFailed");
                die();
            }

            if ($_POST['action'] == "sendCommand" and isset($_POST['command'])) {
                $response = urlHelper::buildDefaultRequest("services/" . $service_name . "/command","PUT", json_encode(array("command" => $_POST['command'])));
                header('Location: ' . urlHelper::get() . "/tasks/" . $task_name . "/" . $service_name  . "/console?action&success=true&message=stopService");
                die();
            }
        }

        include "../resource/view/header.php";
        include "../resource/view/action-modal.php";
        include "../resource/view/dashboard/task/console.php";
        include "../resource/view/footer.php";
    });
});