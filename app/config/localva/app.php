<?php

return array(

    'debug' => true,

    // MCRYPT_RIJNDAEL_128 is Laravel 4.2 Default
    // MCRYPT_RIJNDAEL_256 is from Laravel 4.1 for BC - not needed here though.
    'cipher' => MCRYPT_RIJNDAEL_128,

    'providers' => append_config(array(
        'Way\Generators\GeneratorsServiceProvider',
        'Barryvdh\Debugbar\ServiceProvider'
    ))

);
