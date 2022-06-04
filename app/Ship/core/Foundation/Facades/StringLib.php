<?php

namespace Apiato\Core\Foundation\Facades;

use Illuminate\Support\Facades\Facade;

class StringLib extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'StringLib';
    }
}
