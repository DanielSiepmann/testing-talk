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

Hands on! Let's write a first basic test.

E.g. a small model with a bit logic::

   mkdir -p Tests/Unit/Domain/Model
   cp Resources/Private/CodeExamples/Tests/Unit/Domain/Model/AddressTest.php \
      Tests/Unit/Domain/Model/AddressTest.php

Execute the first test::

   ./vendor/bin/phpunit Tests/Unit/

What's in the test?
-------------------

#. We have one PHP class `AddressTest`.

#. Two public methods.

#. The methods are annotated with `@test`.

#. Methods create an instance of the class to test.

#. Methods call an `assert*()` method.

Create test for controller
--------------------------

Introduction to mocking
^^^^^^^^^^^^^^^^^^^^^^^


Add the test
^^^^^^^^^^^^

We want to test the controller now::

   mkdir -p Tests/Unit/Controller
   cp Resources/Private/CodeExamples/Tests/Unit/Controller/FrontendUserControllerTest.php \
      Tests/Unit/Controller

Execute all tests::

   ./vendor/bin/phpunit Tests/Unit/

Alternative output
------------------

testdox
   Used as "agile" output::

      ./vendor/bin/phpunit Tests/Unit/ --testdox-html Results/testdox.html
      xdg-open Results/testdox.html

xml
   Used in CI to parse results::

     ./vendor/bin/phpunit --log-junit Results/junit.xml Tests/Unit

html Coverage
   Used to check which methods still need testing::

      ./vendor/bin/phpunit --coverage-html Results/Coverage/ --whitelist Classes Tests/Unit
      xdg-open Results/Coverage/index.html

Benefits of tests
-----------------
