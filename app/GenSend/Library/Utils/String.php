<?php namespace GenSend\Library\Utils;

use \GenSend\Library\Interfaces\Utils\RandomNumberGeneratorInterface;
use \GenSend\Library\Interfaces\Utils\StringInterface;
use InvalidArgumentException;
/**
 *  Does things with strings.
 *  Currently only works with English characters, numbers, and some punctuation.
 */
class String implements StringInterface {

    public static $characters = array(
                'fullLowercase'             =>          'abcdefghijklmnopqrstuvwxyz',
                'fullUppercase'             =>          'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
                'nonSimilarLowercase'       =>          'abcdefghjkmnpqrtuvwxyz',
                'nonSimilarUppercase'       =>          'ABCDEFGHJKMNPQRTUVWXYZ',
                'standardNumbers'           =>          '12346789',
                'similar'                   =>          'iIlLoOsS150',
                'punctuation'               =>          '!@#$%^&*?_~()-+:;'
    );
    
    public static $defaultRandomOptions = array(
                'nonSimilarLowercase'       =>          true,
                'nonSimilarUppercase'       =>          true,
                'standardNumbers'           =>          true,
                'punctuation'               =>          false,
                'similar'                   =>          false,
                'checkForRuns'              =>          false // check for repeated runs of characters
    );

    public static $runsRegex = '/(.)\1{3,}/'; // checks for runs of 3 or more repeatd characters
    
    protected $characterSet = '';

    /**
     *  Nato phonetic alphabet
     */
    public static $phonetic = array(
    
                // Letters
                'a' => 'alfa',
                'b' => 'bravo',
                'c' => 'charlie',
                'd' => 'delta',
                'e' => 'echo',
                'f' => 'foxtrot',
                'g' => 'golf',
                'h' => 'hotel',
                'i' => 'india',
                'j' => 'juliet',
                'k' => 'kilo',
                'l' => 'lima',
                'm' => 'mike',
                'n' => 'november',
                'o' => 'oscar',
                'p' => 'papa',
                'q' => 'quebec',
                'r' => 'romeo',
                's' => 'sierra',
                't' => 'tango',
                'u' => 'uniform',
                'v' => 'victor',
                'w' => 'whisky',
                'x' => 'xray',
                'y' => 'yankee',
                'z' => 'zulu',
                
                // numbers
                '0' => 'zero',
                '1' => 'one',
                '2' => 'two',
                '3' => 'three',
                '4' => 'four',
                '5' => 'five',
                '6' => 'six',
                '7' => 'seven',
                '8' => 'eight',
                '9' => 'niner',
                
                // punctuation
                '!' => 'exclamation mark',
                '?' => 'question mark',
                '$' => 'dollar',
                '%' => 'percent',
                '&' => 'ampersand',
                '*' => 'asterisk',
                '^' => 'caret',
                '~' => 'tilde',
                '(' => 'open braces',
                ')' => 'close braces',
                '-' => 'dash',
                '+' => 'plus',
                '@' => 'at',
                '#' => 'hash',
                '_' => 'underscore',
                '£' => 'pound',
                ':' => 'colon',
                ';' => 'semicolon'
    );

    public function __construct(RandomNumberGeneratorInterface $randomNumberGenerator) {
        $this->randomNumberGenerator = $randomNumberGenerator;
    }

    /**
     *    Generates a random string of a length specified
     *
     *    @param    int        The length of the string to return
     *    @param    array      The options to determine our character set to use
     *    @return   string
     * 
     *    @throws InvalidArgumentException If all options passed to the function are false, it has nothing with which to generate a string - just a length
     *
     *    @access    public
     */
    public function randomString($length = 8, $options = array())
    {
        $options += self::$defaultRandomOptions;

        // if every option is false - throw invalid argument exception
        if(count($options) == count(array_keys($options, false))) {
            throw new InvalidArgumentException('Please provide at least one character option to use.');
        }

        $this->characterSet = $this->generateCharacterSetFromOptions($options);

        $string = $this->generateString($this->characterSet, $length);

        if($options['checkForRuns']) {
            $string = $this->checkForRunsAndShuffle($string);
        }

        // Return our string
        return $string;
    }

    /**
     *    Convert a string to the phonetic alphabet.
     *
     * @param The|string $string
     * @param bool $matchCase Match on the case, so A lists as ALPHA and a lists as alpha
     * @param string $separator The string to convert
     * @return   string      The phonetic version of the string given
     *
     * @access   public
     */
    public function toPhonetic($string = '', $matchCase = true, $separator = ' - ')
    {
        $string = trim($string);
        if(strlen($string) == 0)
        {
            return '';
        }
        
        $phonetic = array();
        
        // split our string so we have individual characters to work with
        $characters = str_split($string);
        
        // loop to add phonetic meaning to each character in the string.
        foreach($characters as $position => $character)
        {
            if(array_key_exists($character, self::$phonetic) && $matchCase) // check as they are (lowercase)
            {
                $phonetic[$position] = self::$phonetic[$character];
            }
            elseif(array_key_exists(strtolower($character), self::$phonetic) && $matchCase) // check for uppercase
            {
                $phonetic[$position] = strtoupper(self::$phonetic[strtolower($character)]);
            }
            elseif(array_key_exists(strtolower($character), self::$phonetic) && !$matchCase) // just convert all to lowercase and match here
            {
                $phonetic[$position] = self::$phonetic[strtolower($character)];
            }
            else // we can't find it, it's an unknown... currently this phonetic converter works only on the array specified in this helper class
            {
                $phonetic[$position] = 'UNKNOWN';
            }
        }
        
        return implode($separator, $phonetic); // return our phonetic string separated by our separator
    }

    public function hasRepeatedCharacters($string, $regex = '') {

        if($regex == '') {
            $regex = self::$runsRegex;
        }

        if(preg_match($regex, $string) === 1) {
            return true;
        }
        return false;
    }

    /**
     * @param $options
     * @return string
     */
    public function generateCharacterSetFromOptions($options)
    {
        $characterSet = '';
        // For each option set as true, append the characters for that option to our character set
        foreach ($options as $option => $use) {
            if ($use && array_key_exists($option, self::$characters)) {
                $characterSet .= self::$characters[$option];
            }
        }

        // Let's shuffle the character set to make it a bit more randomly ordered
        $characterSet = str_shuffle($characterSet);

        return $characterSet;
    }

    private function generateString($characterSet, $length)
    {
        $string = '';

        $min = 0;
        $max = strlen($characterSet) - 1;

        while(strlen($string) < $length)
        {
            $string .= $characterSet[$this->randomNumberGenerator->rand($min, $max)];
        }

        return $string;
    }


    public function checkForRunsAndShuffle($string)
    {
        // Now that our string is generated, we'll check for repeated runs and re-shuffle until we have no repeated runs.
        // in a long string, this could take a while
        while($this->hasRepeatedCharacters($string))
        {
            $string = str_shuffle($string);
        }
        return $string;
    }
}