<?php
namespace App\Exceptions;

use Illuminate\Support\Facades\Facade;

class AppExceptions extends Facade{
    /**
     * 
     */
    protected static function getFacadeAccessor() { 
        return 'appexceptions'; 
    }
}
