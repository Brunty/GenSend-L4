<?php namespace GenSend\Events\Handlers;

use Log;

/**
 * Class GenerateHandler
 * @package GenSend\Events\Handlers
 */
class GenerateHandler extends Handler {

    /**
     * @param $password
     */
    public function onCreated($password) {
        //Log::info("Password created.");
    }
}