<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class StringHelperFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'string-helper';
    }
}