<?php namespace GenSend\Events;

use Illuminate\Support\ServiceProvider;

/* 
 *  Generally Service Providers are left for packages,
 *  but they're also a nice way to group bindings etc
 *  rather than just throwing them all in app/start/global.php or something.
 *
 *  So essentially, this is just a bootstrap file for the Gen & Send app.
 *  
 *  Could have added them all into a single Service Provider too, but separated them out just for a bit more organisation... I think.
 *
 *
 *  This service provider is one that registers all event listeners for the app.
 *  That way controllers can just fire events and we don't need to worry about
 *  what does and doesn't use them inside the controllers - we do all of that here.
 */

/**
 * Class EventsServiceProvider
 * @package GenSend\Events
 */
class EventsServiceProvider extends ServiceProvider {
    
    public function register()
    {
        // Generation Event Handlers
        $this->app->events->listen('generate.created', '\GenSend\Events\Handlers\GenerateHandler@onCreated');
        
        // Send Event Handlers
        $this->app->events->listen('send.created', '\GenSend\Events\Handlers\SendHandler@onCreated');
        $this->app->events->listen('send.invalidView', '\GenSend\Events\Handlers\SendHandler@onInvalidView');
        $this->app->events->listen('send.viewed', '\GenSend\Events\Handlers\SendHandler@onViewed');
        $this->app->events->listen('send.viewedFully', '\GenSend\Events\Handlers\SendHandler@onViewedFully');
        $this->app->events->listen('send.manuallyDeleted', '\GenSend\Events\Handlers\SendHandler@onManuallyDeleted');
        $this->app->events->listen('send.expired', '\GenSend\Events\Handlers\SendHandler@onExpired');
    }
}