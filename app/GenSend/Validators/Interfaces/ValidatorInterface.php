<?php namespace GenSend\Validators\Interfaces;

/**
 * Interface ValidatorInterface
 * @package GenSend\Library\Interfaces\Validators
 */
use Illuminate\Support\MessageBag;

/**
 * Interface ValidatorInterface
 * @package GenSend\Validators\Interfaces
 */
interface ValidatorInterface {

    /**
     * @param $input
     * @return mixed
     */
    public function setInput($input);

    /**
     * @return mixed
     */
    public function fails();

    /**
     * @return MessageBag
     */
    public function messages();
}