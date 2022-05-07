<?php

use Pecee\Http\Url;

class ExceptionHandlerFirst
{
    public function handleError(\Pecee\Http\Request $request, \Exception $error) : void
    {
        global $stack;
        $stack[] = static::class;

        $request->setUrl(new Url('/login'));
    }
}