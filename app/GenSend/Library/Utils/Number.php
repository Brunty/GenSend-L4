<?php namespace GenSend\Library\Utils;

use GenSend\Library\Interfaces\Utils\RandomNumberGeneratorInterface;
use InvalidArgumentException;
use RangeException;
use Exception;

/**
 * Class Number
 *
 *  Does with numbers - more secure random numbers too with /dev/urandom as the source for mcrypt_create_iv
 *  increase entropy on the server = good times
 *  maybe extend in future to allow lots of sources, and then mix them
 * @package GenSend\Library\Utils
 */

/** @noinspection PhpUndefinedClassInspection */
class Number implements RandomNumberGeneratorInterface {

    /**
     *    Generates a random number between the two values
     *
     *    @param    int         Number to start at
     *    @param    int         Max number for random generation
     *    @return   int
     * 
     *    @throws InvalidArgumentException If options passed to the function are outside of range
     *
     *    @access    public
     */
    public function rand($min = 0, $max = PHP_INT_MAX)
    {
        // get our range
        $range = $max - $min;
        
        if ($range == 0) return $min; // uh-oh.
        
        $log = log($range, 2);
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        
        do
        {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes, $s)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd >= $range);
        
        return $min + $rnd;
    }
}