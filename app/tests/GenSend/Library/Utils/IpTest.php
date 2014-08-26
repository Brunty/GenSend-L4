<?php

use \GenSend\Library\Utils\Ip;

class IpTest extends \TestCase {

    public function testIpIsWithinRange()
    {
        // Edge case 1
        $start = '192.168.1.2';
        $end = '192.168.1.30';
        $ipToCheck = '192.168.1.2';
        $ip = new Ip;
        $withinRange = $ip->isWithinRange($start, $end, $ipToCheck);
        $this->assertTrue($withinRange);

        // Edge case 2
        $start = '192.168.1.2';
        $end = '192.168.1.30';
        $ipToCheck = '192.168.1.3';
        $ip = new Ip;
        $withinRange = $ip->isWithinRange($start, $end, $ipToCheck);
        $this->assertTrue($withinRange);

        // Middle Case
        $start = '192.168.1.2';
        $end = '192.168.1.30';
        $ipToCheck = '192.168.1.15';
        $ip = new Ip;
        $withinRange = $ip->isWithinRange($start, $end, $ipToCheck);
        $this->assertTrue($withinRange);

        // Edge case 3
        $start = '192.168.1.2';
        $end = '192.168.1.30';
        $ipToCheck = '192.168.1.29';
        $ip = new Ip;
        $withinRange = $ip->isWithinRange($start, $end, $ipToCheck);
        $this->assertTrue($withinRange);

        // Edge case 4
        $start = '192.168.1.2';
        $end = '192.168.1.30';
        $ipToCheck = '192.168.1.30';
        $ip = new Ip;
        $withinRange = $ip->isWithinRange($start, $end, $ipToCheck);
        $this->assertTrue($withinRange);
    }

    public function testIpIsNotWithinRange()
    {
        $start = '192.168.1.2';
        $end = '192.168.1.30';
        $ipToCheck = '192.168.1.31';
        $ip = new Ip;
        $withinRange = $ip->isWithinRange($start, $end, $ipToCheck);
        $this->assertFalse($withinRange);

        $start = '192.168.1.2';
        $end = '192.168.1.30';
        $ipToCheck = '192.168.1.1';
        $ip = new Ip;
        $withinRange = $ip->isWithinRange($start, $end, $ipToCheck);
        $this->assertFalse($withinRange);
    }
}