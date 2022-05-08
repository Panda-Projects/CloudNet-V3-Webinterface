<?php

use App\Helper\fileController;
use Pecee\SimpleRouter\SimpleRouter;

fileController::dieWhenFileMissing();

require fileController::getConfigurationPath();


if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = uniqid();
}

include_once __DIR__ . '/../../routes/web.php';

// Start the routing
try {
    SimpleRouter::start();
} catch (\Pecee\Http\Middleware\Exceptions\TokenMismatchException $e) {
} catch (\Pecee\SimpleRouter\Exceptions\NotFoundHttpException $e) {
} catch (\Pecee\SimpleRouter\Exceptions\HttpException $e) {
} catch (Exception $e) {
}