<?php namespace GenSend\Providers;

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
 * Class ModelServiceProvider
 * @package GenSend\Providers
 */
class ModelServiceProvider extends ServiceProvider {
    
    public function register()
    {
        
    }
}