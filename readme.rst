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

We want to test the model first::

   mkdir -p Tests/Unit/Domain/Model
   cp Resources/Private/CodeExamples/Tests/Unit/Domain/Model/AddressTest.php \
      Tests/Unit/Domain/Model/AddressTest.php

Execute first test::

   ./vendor/bin/phpunit Tests/Unit/

Create test for controller
--------------------------

We want to test the controller now::

   mkdir -p Tests/Unit/Controller
   cp Resources/Private/CodeExamples/Tests/Unit/Controller/FrontendUserControllerTest.php \
      Tests/Unit/Controller

Execute all tests::

   ./vendor/bin/phpunit Tests/Unit/
