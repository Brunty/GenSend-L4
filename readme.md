## Gen & Send Pro!

Included is a Vagrantfile for development within a VM - the VM setup is as follows:


* Debian Wheezy 7.2 x64 - Virtualbox 4.3
* Nginx
* PHP 5.5.8 w/ Composer
* MariaDB 10.0

/var/www/gensendrewrite.dev/

Requires 5.4 at least.

Various development environments are set as well, you'll need to copy .env.default.php to .env.$envName.php and replace the variables with ones corresponding to your own environment. All variables are then available like so:

```
<?php

return array(

    'ENV_KEY' => 'super-secret-sauce',

);
```

```
'array_key' => $_ENV['ENV_KEY']
```

Need to install sqlite for the test environment as it uses sqlite drivers
```
sudo apt-get update
sudo apt-get install sqlite
sudo apt-get install php5-sqlite
```

When you check out this repository, you'll need to create the relevant .env* file(s) for your environment

When updating from this repository, the following is used to setup:

```
$ php artisan down
$ composer update
$ php artisan migrate --env=$envName
$ php artisan db:seed --env=$envName
$ php artisan up
```

