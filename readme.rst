Testing Talk
============

This is about automated testing, for PHP.

Everyone is testing already, by hand. This involves:

* Unit testing

* Functional testing

* Acceptance testing

* Browser testing

* …

All of the above is already done by you, so … NO PANIC!


This is "The Hitchhiker's Guide to […]" testing.

Table of contents:

.. contents:: :local:

Start
-----

Execute the following::

   git clone https://github.com/DanielSiepmann/testing-talk.git
   cd testing-talk

Clean everything::

   rm -rf composer.lock vendor web Tests phpunit.xml.dist infection.json.dist Results

Installation development dependencies using composer::

   composer install

This also includes PHPUnit, see: composer.json

Check installation::

   ./vendor/bin/phpunit --version

This would not work yet, as we do not have any tests::

   ./vendor/bin/phpunit Tests/Unit/

Links:

* https://phpunit.de/

* https://packagist.org/packages/phpunit/phpunit

.. note::

   The concrete PHPUnit version also depends on your current PHP Version.

Create first test
-----------------

Hands on! Let's write a first basic test.

E.g. a small model with a bit logic::

   mkdir -p Tests/Unit/Domain/Model
   cp Resources/Private/CodeExamples/Tests/Unit/Domain/Model/AddressTest.php \
      Tests/Unit/Domain/Model/AddressTest.php

Execute the first test::

   ./vendor/bin/phpunit Tests/Unit/

Execute with colors::

   ./vendor/bin/phpunit --color Tests/Unit/

Execute with info about executed tests::

   ./vendor/bin/phpunit --color --debug Tests/Unit/

What's in the test?
-------------------

#. We have one PHP class `AddressTest`.

#. The class and file ends with `Test`.

#. Two public methods.

#. The methods are annotated with `@test`.

#. Methods create an instance of the class to test.

#. Methods call an `assert*()` method.

Create test for controller
--------------------------

Introduction to mocking
^^^^^^^^^^^^^^^^^^^^^^^

What is mocking, or a mock?

   In object-oriented programming, mock objects are simulated objects that mimic the
   behavior of real objects in controlled ways.

   A programmer typically creates a mock object to test the behavior of some other
   object, in much the same way that a car designer uses a crash test dummy to
   simulate the dynamic behavior of a human in vehicle impacts.

   — https://en.wikipedia.org/wiki/Mock_object

* https://phpunit.de/manual/6.5/en/test-doubles.html

* https://en.wikipedia.org/wiki/Mock_object

Add the test
^^^^^^^^^^^^

We want to test the controller now::

   mkdir -p Tests/Unit/Controller
   cp Resources/Private/CodeExamples/Tests/Unit/Controller/FrontendUserControllerTest.php \
      Tests/Unit/Controller

Execute all tests::

   ./vendor/bin/phpunit --color --debug Tests/Unit/

Alternative output
------------------

testdox
   Used as "agile" output::

      ./vendor/bin/phpunit Tests/Unit/ --color --testdox-html Results/testdox.html
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

#. Detect new bugs.

#. Make sure the same bug does not occur a 2nd time.

#. Reproduce bug.

#. Speed up development.

#. Show how to use the written code.

#. Allow co-worker, in pull request, to see what you expect.
   And how you understood the feature-request.

#. Write code without working system, by using tests instead.

#. Allow more secure refactoring.

#. Forces to write clean code.

Automate test execution
-----------------------

Existing tests are great. If they are executed.

Tests which exist are code, if they are not executed, they are dead code.

Tests costs money, so get the money back by executing tests.

The easiest way is to have an CI (=Continuous Integration).

E.g.:

* Jenkins

* Travis

* Gitlab CI

* Bitbucket Pipelines

* Bamboo

* Circle CI

* …

See: https://awesomelists.top/#/repos/ciandcd/awesome-ciandcd

Use `phpunit.xml.dist`::

   cp Resources/Private/Configs/phpunit.xml.dist phpunit.xml.dist

   ./vendor/bin/phpunit

Metrics
-------

Code Coverage
^^^^^^^^^^^^^

Most of the time counts only number of executed lines.

This helps to find untested code, nothing more!
100% covered lines does not mean you are testing all circumstances,
just every line at least once.

E.g.:

.. code-block:: php

   <?php

       if ($var1 || $var2) {
           echo 'test';
       }

   ?>

Will have 100% if all lines are executed, that is even if we do not provide `$var2`.
We have to test the possible cases, not only all lines.

* https://stackoverflow.com/a/90021/1888377

* https://www.martinfowler.com/bliki/TestCoverage.html

* https://phpunit.de/manual/6.5/en/code-coverage-analysis.html

Crap
^^^^

Is not:

   https://img.devrant.com/devrant/rant/r_1046201_T68wf.jpg

   — https://devrant.com/search?term=code+reviews


Is: change risk anti pattern score
   Combines complexity and test coverage.

Different kinds of tests
------------------------

* https://stackoverflow.com/a/4145576/1888377

* http://www.getlaura.com/testing-unit-vs-integration-vs-regression-vs-acceptance/

* https://en.wikipedia.org/wiki/Category:Software_testing
  Lists: Acid tests, Unit testing, A/B testing, Acceptance testing, Ad hoc testing,
  Agile testing, All-pairs testing, API testing, Black-box testing & White-box
  testing, Boundary testing, Cloud testing, Compatibility testing, Component-based
  usability testing, …

Unit Tests
^^^^^^^^^^

What we did above. White box test of small pieces of code.

Functional Tests
^^^^^^^^^^^^^^^^

Involves multiple code parts, database, file system and further components, e.g. web
server.

Acceptance Tests
^^^^^^^^^^^^^^^^

Tests from user view, e.g. via browser.

Mutation testing
^^^^^^^^^^^^^^^^

Tests how easy it is to break test::

   cp Resources/Private/Configs/infection.json.dist infection.json.dist

   ./vendor/bin/infection

* https://infection.github.io/

* https://infection.github.io/guide/mutators.html

* https://en.wikipedia.org/wiki/Mutation_testing

Summary
-------

Start writing tests, small unit tests.

Automate execution of tests.

Improve.

Further reading
---------------

* https://github.com/DanielSiepmann/testing-talk/tree/develop

* https://phpunit.de/

* https://awesomelists.top/#repos/ziadoz/awesome-php

* https://en.wikipedia.org/wiki/Category:Software_testing

* Source code of open source projects, like TYPO3:
  https://github.com/TYPO3/TYPO3.CMS/tree/master/typo3/sysext/core/Tests
