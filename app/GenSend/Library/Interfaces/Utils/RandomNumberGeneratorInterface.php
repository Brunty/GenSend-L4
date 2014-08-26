<?php namespace GenSend\Library\Interfaces\Utils;

/**
 * Interface RandomNUmberGeneratorInterface
 * @package GenSend\Library\Interfaces\Utils
 */
interface RandomNUmberGeneratorInterface {

    /**
     * @param int $min
     * @param int $max
     * @return mixed
     */
    public function rand($min = 0, $max = PHP_INT_MAX);
}