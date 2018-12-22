<?php

namespace Yeates\Visitor\Facades;

use Illuminate\Support\Facades\Facade;


class TaoBaoIpChannel extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Yeates\Visitor\TaoBaoIpChannel::class;
    }
}
