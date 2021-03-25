<?php
namespace App\Support;

use Illuminate\Support\Facades\Facade;

class AppCryption extends Facade{
    /**
     * 
     */
    protected static function getFacadeAccessor() { 
        return 'appcryption'; 
    }
}
