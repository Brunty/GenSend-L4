<?php

use \GenSend\Library\Utils\String;
use \GenSend\Library\Utils\Number as RandomNumber;

class StringTest extends \TestCase {

    protected $timesToRun = 100;
    protected $string;
    
    protected $lengths = array(0, 1, 5, 8, 12, 34, 64, 128, 256, 512);

    public function setUp() {
        parent::setUp();
        $this->string = new String(new RandomNumber);
    }

    public function testGenerateRandomStringLength()
    {
        foreach($this->lengths as $length) {
            $string = $this->string->randomString($length);
            $this->assertEquals($length, strlen($string));
        }
    }

    public function testStringToPhoneticIncludingPunctuationandSimilar() {
        $inputString = '7-mjfQ1r-@';
        $expectedResult = 'seven - dash - mike - juliet - foxtrot - QUEBEC - one - romeo - dash - at';

        $result = $this->string->toPhonetic($inputString);
        $this->assertEquals($result, $expectedResult);
    }

    public function testStringToPhoneticIsEmpty() {
        $inputString = '';
        $expectedResult = '';

        $result = $this->string->toPhonetic($inputString);
        $this->assertEquals($result, $expectedResult);
    }

    public function testStringToPhoneticDontMatchCase() {
        $inputString = 'ajBde';
        $expectedResult = 'alfa - juliet - bravo - delta - echo';
        $matchCase = false;

        $result = $this->string->toPhonetic($inputString, $matchCase);
        $this->assertEquals($result, $expectedResult);
    }

    public function testStringToPhoneticDontMatchCaseUnknownResult() {
        $inputString = 'ajBde]';
        $expectedResult = 'alfa - juliet - bravo - delta - echo - UNKNOWN';
        $matchCase = false;

        $result = $this->string->toPhonetic($inputString, $matchCase);
        $this->assertEquals($result, $expectedResult);
    }

    public function testGenerateRandomStringDoesNotContainPunctuation()
    {
        // generate 10000 random strings and never see results that we want to, unlikely, but it can happen!
        $punctuation = String::$characters['punctuation'];

        $stringGenerated = '';
        for($i = 0; $i < $this->timesToRun; $i++) {
            $newString = $this->string->randomString();
            $result = preg_match("/[" . $punctuation . "]/i", $newString);
            $this->assertEquals(0, $result);
        }
    }

    /*
        Technically not a unit test? This is more of a "make sure it doesn't contain a run of characters test"
        It's completely random, we could generate 100,000 strings and never see 3 chars in a row, or we could
        generate 100,000 and see 100 instances of 3 chars in a row. Technically, not a fail, just a notice about it.

        More of a test for FIPS compliance than a unit test.
        
        The longer a string gets, the more likely it is to have repeated runs...
    */
    public function testGenerateRandomStringDoesNotContainRuns() {

        
        $regex = String::$runsRegex; // checks that a string doesn't contain 3 or more chars / numbers / etc in a row
        $options = String::$defaultRandomOptions;
        $options['checkForRuns'] = true; // make sure that we don't allow runs in our sequences of characters

        for($i = 0; $i < $this->timesToRun; $i++) {
            foreach($this->lengths as $length) {
                $newString = $this->string->randomString($length, $options);
                $result = preg_match($regex, $newString);
                $this->assertEquals(0, $result);
            }
        }
    }

    public function testHasRepeatedCharacters() {
        $string = 'somestringgoeshhhhhhere';
        $this->assertTrue($this->string->hasRepeatedCharacters($string));
    }

    public function testDoesNotHaveRepeatedCharacters() {
        $string = 'somestringgoeshere';
        $this->assertFalse($this->string->hasRepeatedCharacters($string));
    }

    public function testCheckForRunsAndNotShuffled() {
        $string = 'somestringgoeshere';
        $this->assertEquals($string, $this->string->checkForRunsAndShuffle($string));
    }

    public function testCheckForRunsAndShuffled() {
        $string = 'somestringgoeshhhhhhere';
        $this->assertNotEquals($string, $this->string->checkForRunsAndShuffle($string));
    }
}