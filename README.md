
Slim Unit Testing Example
================================================================================

SlimPHP is a great framework with a small footprint and everything you need to
build fast applications. I've found it particularly well suited to delivering
data to [BackboneJS][bb] applications.

However, I haven't found a great deal of information about integration and unit
testing with Slim, and have developed my own approach. I've refactored and
introduced it into this sample application. I hope it will help others on their
path to using this great framework.

## Example

```php
    class VersionTest extends Slim_Framework_TestCase {
        public function testVersion() {
            $this->get('/version');
            $this->assertEquals(200, $this->response->status());
            $this->assertEquals($this->app->config('version'), $this->response->body());
        }
    }
```

## Installation

Run `composer install` and then `phpunit`. This application assumes that you
have `phpunit` installed globally on your system. This application can be run as
a functioning website. You can you use the sample apache config file in the
`build/` folder, or use the native php webserver. To use the php webserver, run
`php -S localhost:8080 -t public/` from the project root and open your browser
to [http://localhost:8080][lh]

## Concepts

The `build/index.php` file serves as the application entry point. This file
initializes a SlimPHP `$app` with production configuration, includes the routes
file from `app/app.php` and then runs the app with `$app->run();`. This allows
us to keep our application separate from the index, and gives us an opportunity
to include our app file in a different context.

When phpunit runs, it looks for the phpunit.xml file in our root. This file
specifies a testing bootstrap file. PHPUnit includes `testing/bootstrap.php`.
This file creates an `$app`, just like in `build/index.php`, but it uses
testing configuration. The bootstrap keeps a reference to `$app` for the testing
framework, and then provides several helper methods for `GET`, `POST`, `PUT`,
`PATCH`, `HEAD`, and `DELETE`.

With these method, you can run end to end tests on SlimPHP routes without need
for a webserver. The tests run within a mock enviroment, and will be fast and
efficient. 

## Unit Testing vs. Integration Testing

Unit tests should test an individual part of code. The system under test should
be as small as possible. You would unit test an individual method. Integration
testing exercises an entire system. Most of this example is about integration
testing. We are running tests that work Slim from initial instantiation to the
final delivery of data. With integration tests, we're treating the entire
application as a unit, setting up a particular initial environment and then
executing the `run()` command and finally inspecting the results to ensure that
they match our expectations

## Mocking with SlimPHP

See the [ZenTest][zen_test] for an example of mocking with SlimPHP dependency
injection. You can read more about mocking in the [SlimDocs on DI][di].

## Ideas and Extensions

I've considered adding custom PHPUnit assertions that mirror the
[Status Introspection][si] methods of SlimPHP. We could have tools like 
`$this->assertResponseOK();` or `$this->assertResponseBody('Some content');`.
I'm not sure that I like these more than the current more verbose matchers, but
it might be worth exploring.

At the moment, the helpers for `PUT`, `PATCH`, `HEAD`, and `DELETE` are
untested.

## Thanks

Thanks must be given to [Nicholas Humfrey][njh] for his work in this
[integration testing harness][njh_test].

[si]: http://docs.slimframework.com/#Response
[di]: http://docs.slimframework.com/#Dependency-Injection
[zen_test]: https://github.com/there4/slim-unit-testing-example/blob/master/tests/integration/ZenTest.php
[lh]: http://localhost:8080
[bb]: http://backbonejs.org
[njh]: https://github.com/njh
[njh_test]: https://github.com/njh/njh.me/blob/master/test/IntegrationTest.php
