<?php namespace GenSend\Tests\Controllers;
use TestCase;
use Route;
use Cache;

class GenerateControllerTest extends TestCase {

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
        $this->call('GET', 'gen');

        $this->assertResponseOk();
    }

    /**
     * @return void
     */
    public function testPostGenerateIsOk()
    {
        $this->client->restart();
        $data = array(
            'length'                    =>          32,
            'nonSimilarLowercase'       =>          true,
            'nonSimilarUppercase'       =>          true,
            'standardNumbers'           =>          true,
            'punctuation'               =>          false,
            'similar'                   =>          false,
            'checkForRuns'              =>          false // check for repeated runs of characters
        );
        $response = $this->call('POST', '/gen', $data);
        $this->assertResponseOk();
    }


    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testPostGenerateFailsValidation()
    {
        $this->client->restart();
        $response = $this->call('POST', '/gen');
        $this->assertRedirectedTo('gen');
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testPostGenerateFailsValidationLowNumber()
    {
        $this->client->restart();
        $data = array(
            'length'                    =>          3,
            'nonSimilarLowercase'       =>          true,
            'nonSimilarUppercase'       =>          true,
            'standardNumbers'           =>          true,
            'punctuation'               =>          false,
            'similar'                   =>          false,
            'checkForRuns'              =>          false // check for repeated runs of characters
        );
        $response = $this->call('POST', '/gen', $data);
        $this->assertRedirectedTo('gen');
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testPostGenerateFailsValidationHighNumber()
    {
        $this->client->restart();
        $data = array(
            'length'                    =>          100,
            'nonSimilarLowercase'       =>          true,
            'nonSimilarUppercase'       =>          true,
            'standardNumbers'           =>          true,
            'punctuation'               =>          false,
            'similar'                   =>          false,
            'checkForRuns'              =>          false // check for repeated runs of characters
        );
        $response = $this->call('POST', '/gen', $data);
        $this->assertRedirectedTo('gen');
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testPostGenerateFailsInvalidArguments()
    {
        $this->client->restart();
        $data = array(
            'length'                    =>          32,
            'nonSimilarLowercase'       =>          false,
            'nonSimilarUppercase'       =>          false,
            'standardNumbers'           =>          false,
            'punctuation'               =>          false,
            'similar'                   =>          false,
            'checkForRuns'              =>          false // check for repeated runs of characters
        );
        $response = $this->call('POST', '/gen', $data);
        $this->assertRedirectedTo('gen');
        $this->assertRedirectedTo('gen');
    }
}