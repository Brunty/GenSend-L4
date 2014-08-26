<?php

/*
|--------------------------------------------------------------------------
| Register The Artisan Commands
|--------------------------------------------------------------------------
|
| Each available Artisan command must be registered with the console so
| that it is available to be called. We'll register every command so
| the console gets access to each of the command object instances.
|
*/

Artisan::add(
    new SecuresendDeleteOldCommand(
        new \GenSend\Repositories\EloquentSendRepository(
            new \Securesend,
            new \GenSend\Library\Utils\String(
                new \GenSend\Library\Utils\Number
            )
        )
    )
);

Artisan::add(
    new SecuresendCreateCommand(
        new \GenSend\Repositories\EloquentSendRepository(
            new \Securesend,
            new \GenSend\Library\Utils\String(
                new \GenSend\Library\Utils\Number
            )
        )
    )
);

Artisan::add(
    new SecuresendClearEverythingCommand(
        new \GenSend\Repositories\EloquentSendRepository(
            new \Securesend,
            new \GenSend\Library\Utils\String(
                new \GenSend\Library\Utils\Number
            )
        )
    )
);