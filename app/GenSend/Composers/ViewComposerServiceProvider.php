<?php namespace GenSend\Composers;

use Illuminate\Support\ServiceProvider;
use View;

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
 * Class ViewComposerServiceProvider
 * @package GenSend\Composers
 */
class ViewComposerServiceProvider extends ServiceProvider {
    
    public function register()
    {
        // Main layout Composer - Effectively gives us the ability to pass things to the 'Chrome' of the site on every request.
        \View::composer('Layouts.main', 'GenSend\Composers\Layouts\MainComposer');
    }
}