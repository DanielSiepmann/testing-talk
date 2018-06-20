Testing Talk
============

Clean everything::

   rm -rf composer.lock vendor web Tests

Install dependencies
--------------------

Using composer::

   composer install

PHPUnit Installation
--------------------

Install phpunit::

   composer require --dev phpunit/phpunit ^6.5

Why 6.x? We use 6.x to support PHP 7.0.

Check installation::

   ./vendor/bin/phpunit --version

Links:

* https://phpunit.de/

* https://packagist.org/packages/phpunit/phpunit

Create first test
-----------------

We want to test the controller first::

   mkdir -p Tests/Unit/Domain/Model
   cp Resources/Private/CodeExamples/Tests/Unit/Domain/Model/AddressTest.php \
      Tests/Unit/Domain/Model/AddressTest.php

Execute first test::

   ./vendor/bin/phpunit Tests/Unit/
