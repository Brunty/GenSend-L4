<?php namespace GenSend\Library\Utils;

/**
 * Class Ip
 * @package GenSend\Library\Utils
 */
class Ip {

    /**
     * @param string $start
     * @param string $end
     * @param string $ip
     * @return bool
     */
    public function isWithinRange($start = '00.00.00.00', $end = '00.00.00.00', $ip = '00.00.00.00') {
        $rangeStart = ip2long($start);
        $rangeEnd   = ip2long($end);
        $ip          = ip2long($ip);
        if ($ip >= $rangeStart && $ip <= $rangeEnd) {
            return true;
        }
        return false;
    }

    /**
     * dtr_pton
     * Converts a printable IP into an unpacked binary string
     * @author Mike Mackintosh - mike@bakeryphp.com
     * @param string $ip
     * @throws \Exception
     * @return string $bin
     */
    public function dtr_pton($ip) {
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4))
        {
            return current( unpack( "A4", inet_pton( $ip ) ) );
        }
        elseif (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6))
        {
            return current( unpack( "A16", inet_pton( $ip ) ) );
        }

        throw new \Exception("Please supply a valid IPv4 or IPv6 address");
    }

    /**
     * dtr_ntop
     * Converts an unpacked binary string into a printable IP
     * @author Mike Mackintosh - mike@bakeryphp.com
     * @param string $str
     * @throws \Exception
     * @return string $ip
     */
    public function dtr_ntop($str) {
        if( strlen( $str ) == 16 OR strlen( $str ) == 4 )
        {
            return inet_ntop( pack( "A".strlen( $str ) , $str ) );
        }
        
        throw new \Exception( "Please provide a 4 or 16 byte string" );
    }
     
     
}