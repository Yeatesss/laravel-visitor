<?php

namespace Yeates\Visitor\Facades;

use Illuminate\Support\Facades\Facade;


class CzIpChannel extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Yeates\Visitor\Channels\CzIpChannel::class;
    }
}
