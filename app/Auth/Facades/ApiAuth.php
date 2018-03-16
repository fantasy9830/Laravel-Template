<?php

namespace App\Auth\Facades;

use Illuminate\Support\Facades\Facade;

class ApiAuth extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'apiauth';
    }
}
