<?php
namespace App\Http\Helpers;

use Illuminate\Support\Facades\App;

class AppExceptions {
    /**
     * Variable that will return the exception message
     */
    protected $message;


    /**
     * This method will accept & throwback the app generated exceptions
     */
    public function throwback($th){

        /**
         * App::environment()
         * Checking the application environment
         * local, development, stage, prodection
         */
        switch (App::environment()) {
            case 'local':
                $this->message = $th->getMessage();
                break;

            case 'development':
                $this->message = $th->getMessage();
                break;
            
            case 'stage':
                $this->message = $th->getMessage();
                break;
            
            default:
                $this->message = 'Something went wrong. Please contact to the support team!';
                break;
        }
    
        return [
            'message'   => $this->message, 
            'alert-type'    =>  'warning'
        ];
    }
}
