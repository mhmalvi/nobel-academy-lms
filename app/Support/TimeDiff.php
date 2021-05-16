<?php
namespace App\Support;

use Illuminate\Support\Facades\Facade;

class TimeDiff extends Facade{
    /**
     * 
     */
    protected static function getFacadeAccessor() { 
        return 'timediff'; 
    }
}
