<?php

namespace App\Http\Middleware;

use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;
use Pecee\Http\Url;

class AuthMiddleware implements IMiddleware
{

    public function handle(Request $request): void
    {
        $request->setUrl(new Url('login'));
    }
}