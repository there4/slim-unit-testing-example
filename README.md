Slim Unit Testing Example [![Build Status](https://travis-ci.org/there4/slim-unit-testing-example.png?branch=master)](https://travis-ci.org/there4/slim-unit-testing-example) [![Code Climate](https://codeclimate.com/github/there4/slim-unit-testing-example/badges/gpa.svg)](https://codeclimate.com/github/there4/slim-unit-testing-example)
================================================================================
> Integration and unit testing a Slim PHP application (Slim V2.x)

## Slim V2.x
The current stable master of this project is for Slim V2.x. Work is in progress
to bring this to the new Slim 3.

This is a sample application to show an approach to integration and unit testing
a [Slim][slim] application. To skip to the heart of this, go check out the
[testing bootstrap][bootstrap]. It sets a mock environment and provides some
helper methods for testing Slim routes.

## About

[Slim][slim] is a great PHP framework with a small footprint and everything you
need to build fast applications. I've found it particularly well suited to
delivering data to [BackboneJS][bb] applications.

However, I haven't found a great deal of information about integration and unit
testing with Slim, and have developed my own approach. I've refactored and
introduced it into this sample application. I hope it will help others on their
path to using this great framework.

This application demonstrates some techniques for integration and unit testing.
With this approach, you'll be able to test your application without the need of
Curl, webservers, or anything other than [PHPUnit][phpunit] installed on your
system. This makes it easy to test your entire app in an automated way with
[TravisCI][tci]. Check out the [.travis.yml][yml] file in this project for an
example.

## Example

Here's [a test][version_test] for a very simple endpoint that returns the
version from the application config. We're asserting that Slim responded with a
`200` and that the version matches what we expect.

```php
class VersionTest extends LocalWebTestCase {
    public function testVersion() {
        $this->client->get('/version');
        $this->assertEquals(200, $this->client->response->status());
        $this->assertEquals($this->app->config('version'), $this->client->response->body());
    }
}
```

## Installation

Clone the repository and then run `composer install` and then `phpunit`. This
application assumes that you have `phpunit` installed globally on your system.
This application can be run as a functioning website. You can you use the sample
apache config file in the `build/` folder, or use the native php webserver. To
use the php webserver, run `php -S localhost:8080 -t public/` from the project
root and open your browser to [http://localhost:8080][lh]

## Concepts

The `public/index.php` file serves as the application entry point. This file
initializes a Slim `$app` with production configuration, includes the routes
file from `app/app.php` and then runs the app with `$app->run();`. This allows
us to keep our application separate from the index, and gives us an opportunity
to include our `app/app.php` file in a different context.

When phpunit runs, it looks for the phpunit.xml file in our root. This file
specifies a testing bootstrap file. PHPUnit includes `testing/bootstrap.php`.
This file creates an `$app`, just like in `build/index.php`, but it uses
testing configuration. The bootstrap keeps a reference to `$app` for the testing
framework, and then provides several helper methods for `GET`, `POST`, `PUT`,
`PATCH`, `HEAD`, and `DELETE`.

With these methods, you can run tests on Slim routes without a webserver. The
tests run entirely within a mock environment and will be fast and efficient.

## Unit Testing vs. Integration Testing

Unit tests should test an individual part of code. The system under test should
be as small as possible. You would unit test an individual method. Integration
testing exercises an entire system. Most of this example is about integration
testing. We are running tests that work Slim from initial instantiation to the
final delivery of data. With integration tests, we're treating the entire
application as a unit, setting up a particular initial environment and then
executing the `run()` command and finally inspecting the results to ensure that
they match our expectations.

## Mocking with Slim

See the [ZenTest][zen_test] for an example of mocking with Slim dependency
injection. In this test we mock a Curl wrapper class from [Shuber][shuber]. This
allows us to substitute responses and exercise the parts of our application that
we feel need testing. It also allows us to run these unit tests on systems that
don't have the curl extension installed. We're totally isolated from that
dependency while this running test.

The [FileStoreTest][file_test] uses a mock for the authentication
class. Notice that the file store route doesn't use that class directly, but
instead it is used by the application authenticator method. We're using the app
dependency injection container to swap out the real object for a mock version.
This approach allows us to control authentication results from within our test
harness.

You can read more about dependency injection in the [SlimDocs on DI][di], and
more about mock objects in the [PHPUnit docs][php_mock].

## Site Tooling

I'd like to give a nod to [Pake][pake]. It's a flexible and powerful build tool
written in PHP. If you've got lots of JavaScript, I might recommend
[Grunt][grunt] or [Gulp][gulp]. However, for APIs and other sites that need a
build system - I highly recommend Pake. It's got enough tools to handle SSH
deployments and other sophisticated build steps. In this project, it's used to
setup the dev web server and handle some code sniffs. With the
[Pake CLI][pake-cli] tool you don't have to install it globally. I think
it's a compelling and overlooked tool. [Go see it][pake]!

## Contributing

Open an [issue][issues] for questions, comments, or suggestions. Pull requests
are welcome, please format the code to PSR-2 standards and include an
explanation of the benefits.


## Contributors

| Author | Commits
| --- | ---
| Craig Davis | 63 |
| Jeremy Kendall | 3 |
| guillermo-fisher | 1 |

## Changelog

* 0.1.1 Update Readme and remove `echo` and `include` in place of a proper
  rendering.
* 0.1.0 Backwards compatibility breaking - Reorder the parameters on the
  `get()`, `post()` and http testing methods to be in the new order of
  `$this->$method($path, $formVars, $optionalHeaders);`. This makes the testing
  a little more terse, and clears up any confusion with improved parameter
  names.
* 0.0.9 Bug fix for [issue 4][issue4], with thanks to origal for his work in
  solving a problem with get parameters.


## Thanks

Thanks must be given to [Nicholas Humfrey][njh] for his work in this
[integration testing harness][njh_test].

[grunt]: http://gruntjs.com/
[gulp]: http://gulpjs.com/
[pake]: https://github.com/indeyets/pake
[pake-cli]: https://github.com/there4/pake-cli
[bb]: http://backbonejs.org
[bootstrap]: https://github.com/there4/slim-unit-testing-example/blob/master/tests/bootstrap.php
[di]: http://docs.slimframework.com/#Dependency-Injection
[file_test]: https://github.com/there4/slim-unit-testing-example/blob/master/tests/integration/FileStoreTest.php
[issue4]: https://github.com/there4/slim-unit-testing-example/issues/4
[issues]: https://github.com/there4/slim-unit-testing-example/issues
[lh]: http://localhost:8080
[njh]: https://github.com/njh
[njh_test]: https://github.com/njh/njh.me/blob/master/test/IntegrationTest.php
[php_mock]: http://phpunit.de/manual/3.0/en/mock-objects.html
[phpunit]: http://phpunit.de/manual/current/en/index.html
[shuber]: https://github.com/shuber/curl
[si]: http://docs.slimframework.com/#Response
[slim]: http://www.slimframework.com/
[tci]: http://travis-ci.org
[version_test]: https://github.com/there4/slim-unit-testing-example/blob/master/tests/integration/VersionTest.php
[yml]: https://github.com/there4/slim-unit-testing-example/blob/master/.travis.yml
[zen_test]: https://github.com/there4/slim-unit-testing-example/blob/master/tests/integration/ZenTest.php
