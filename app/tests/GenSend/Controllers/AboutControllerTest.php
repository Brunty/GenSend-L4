<?php namespace GenSend\Tests\Controllers;
use TestCase;
use Route;

class AboutControllerTest extends TestCase {

    public function setUp() {
        parent::setUp();

        Route::enableFilters();
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testGetIndexIsOk()
    {
        $this->client->restart();
        $this->call('GET', 'about');

        $this->assertResponseOk();
    }
}