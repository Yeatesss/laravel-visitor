<?php

namespace Yeates\Visitor\Facades;

use Illuminate\Support\Facades\Facade;


class FreeIpChannel extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Yeates\Visitor\FreeIpChannel::class;
    }
}
