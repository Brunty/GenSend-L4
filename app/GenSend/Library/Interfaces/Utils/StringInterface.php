<?php namespace GenSend\Library\Interfaces\Utils;

/**
 * Interface StringInterface
 * @package GenSend\Library\Interfaces\Utils
 */
interface StringInterface {

    /**
     * @param int $length
     * @param array $options
     * @return mixed
     */
    public function randomString($length = 8, $options = array());

    /**
     * @param $string
     * @param $matchCase
     * @param $separator
     * @return mixed
     */
    public function toPhonetic($string, $matchCase, $separator);
}