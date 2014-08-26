<?php namespace GenSend\Providers;

use GenSend\Library\Utils\Number;
use GenSend\Library\Utils\String;
use GenSend\Validators\GenerateFormValidator;
use GenSend\Validators\SendFormValidator;
use GenSend\Repositories\EloquentSendRepository;
use HomeController;
use GenerateController;
use SendController;
use Illuminate\Support\ServiceProvider;

/* 
 *  Generally Service Providers are left for packages,
 *  but they're also a nice way to group bindings etc
 *  rather than just throwing them all in app/start/global.php or something.
 *
 *  So essentially, this is just a bootstrap file for the Gen & Send app.
 *  
 *  Could have added them all into a single Service Provider too, but separated them out just for a bit more organisation... I think.
 */

/**
 * Class ControllerServiceProvider
 * @package GenSend\Providers
 */
class ControllerServiceProvider extends ServiceProvider {
    
    public function register()
    {
        // Bind our Generate Controller to the App and pass in the PasswordFormValidator
        $this->app->bind('GenerateController', function($app) {
            return new GenerateController(
                new GenerateFormValidator,
                new String(new Number)
            );
        });

        // Bind our Send Controller to the App and pass in the PasswordFormValidator
        $this->app->bind('SendController', function($app) {
            return new SendController(
                new SendFormValidator,
                new EloquentSendRepository(
                    new \Securesend,
                    new String(new Number)
                )
            );
        });

        $this->app->bind('HomeController', function($app) {
            return new HomeController;
        });
    }
}