<?php namespace GenSend\Tests\Controllers;
use Illuminate\Support\Facades\Request;
use Testcase;
use Route;

class SendControllerTest extends TestCase {

    public function setUp() {
        parent::setUp();
        $app = $this->createApplication();
        $app->make('artisan')->call('migrate');
        Route::enableFilters();
        Request::setSession($this->app['session.store']); // needed otherwise RuntimeException is thrown as we're using Session in the view file for things like errors etc.
    }
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testIndexIsOk()
    {
        $this->client->restart();
        $this->call('GET', 'send');

        $this->assertResponseOk();

    }
}