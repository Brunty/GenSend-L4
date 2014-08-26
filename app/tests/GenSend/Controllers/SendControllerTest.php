<?php namespace GenSend\Tests\Controllers;
use Testcase;
use Route;

class SendControllerTest extends TestCase {
    public function setUp() {
        parent::setUp();
        $app = $this->createApplication();
        $app->make('artisan')->call('migrate');
        Route::enableFilters();
    }
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testIndexIsOk()
    {

    }
}