<?php

namespace Yeates\Visitor\Facades;

use Illuminate\Support\Facades\Facade;


class VisitorLog extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Yeates\Visitor\VisitorLog::class;
    }
}
