<?php

use App\Helper\fileController;
use Pecee\Http\Middleware\Exceptions\TokenMismatchException;
use Pecee\Http\Request;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use Pecee\SimpleRouter\SimpleRouter;

if(isset($_SESSION["lang"])) {
    require __DIR__ . '../../../lang/lang_' . $_SESSION["lang"] . '.php';
} else {
    require __DIR__ . '../../../lang/lang_en.php';
}

fileController::dieWhenFileMissing();

require fileController::getConfigurationPath();

SimpleRouter::error(function(Request $request, \Exception $exception) {

    print_r($exception->getCode());

});

if (!isset($_SESSION['csrf'])) {
    $_SESSION['csrf'] = uniqid();
}

include_once __DIR__ . '/../../routes/web.php';

// Start the routing
try {
    SimpleRouter::start();
} catch (TokenMismatchException | NotFoundHttpException | \Pecee\SimpleRouter\Exceptions\HttpException $e) {
} catch (Error $e) {
    include __DIR__ . '/../../resource/error/500.php';
}
