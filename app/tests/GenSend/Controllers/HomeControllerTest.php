<?php namespace GenSend\Tests\Controllers;
use Testcase;
use Route;

class HomeControllerTest extends TestCase {

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testIndexIsOk()
    {
        $this->client->restart();
        $crawler = $this->client->request('GET', '/');

        $this->assertTrue($this->client->getResponse()->isOk());
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testGetGenerateIsOk()
    {
        $this->client->restart();
        $crawler = $this->client->request('GET', '/gen');

        $this->assertTrue($this->client->getResponse()->isOk());
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testGETGenerate404()
    {
        $this->client->restart();
        $this->setExpectedException('Symfony\Component\HttpKernel\Exception\NotFoundHttpException');
        $this->call('GET', '/asdasd');
    }

}