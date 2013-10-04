
Slim Unit Testing Example
================================================================================

SlimPHP is a great framework with a small footprint and everything you need to
build fast applications. I've found it particularly well suited to delivering
data to [BackboneJS][bb] applications.

However, I haven't found a great deal of information about integration and unit
testing with Slim, and have developed my own approach. I've refactored and
introduced it into this sample application. I hope it will help others on their
path to using this great framework.

# Installation

Run `composer install` and then `phpunit`. This application assumes that you
have `phpunit` installed globally on your system. This application can be
installed to run as a functioning website, use the sample config files in the
`build/` folder for this.

# Concepts

# Unit Testing vs. Integration Testing

# Developing New Tests

# Thanks

Thanks must be given to [Nicholas Humfrey][njh] for his work in this
[integration testing harness][njh_test].

[bb]: http://backbonejs.org
[njh]: https://github.com/njh
[njh_test]: https://github.com/njh/njh.me/blob/master/test/IntegrationTest.php
