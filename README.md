# Germania KG · Prices

[![Packagist](https://img.shields.io/packagist/v/germania-kg/prices.svg?style=flat)](https://packagist.org/packages/germania-kg/prices)
[![PHP version](https://img.shields.io/packagist/php-v/germania-kg/prices.svg)](https://packagist.org/packages/germania-kg/prices)
[![Build Status](https://img.shields.io/travis/GermaniaKG/Prices.svg?label=Travis%20CI)](https://travis-ci.org/GermaniaKG/Prices)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/GermaniaKG/Prices/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/Prices/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/GermaniaKG/Prices/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/Prices/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/GermaniaKG/Prices/badges/build.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/Prices/build-status/master)

**This package was destilled from legacy code!**   
You better do not want it to use this in production.


## Installation

```bash
$ composer require germania-kg/prices
```

**MySQL:** This package requires a MySQL table *germania_prices* which you can install using `germania_prices.sql` in `sql/` directory.


## Usage

*PdoPrices* is a Callable for retrieving prices for any given article ID. It implements the [container-interop](https://github.com/container-interop/container-interop) (upcoming [PSR 11](https://github.com/php-fig/fig-standards/blob/master/proposed/container.md) standard). 

```php
<?php
use Germania\Prices\PdoPrices;

$prices_factory = new PdoPrices( $pdo );
$prices_factory = new PdoPrices( $pdo, "my_custom_table" );

// Assume article has ID 42
$article = ...

// ContainerInterface:
$complete = $prices_factory->has( 42 );

// Getting may throw NoPriceFoundException
// Interop\Container\Exception\NotFoundException)
$prices = $prices_factory->get( 42 );


// Avoid Exception using __invoke:
// Returns always array, may be empty:
$prices = $prices_factory( 42 );


?>
```

## Development

```bash
$ git clone https://github.com/GermaniaKG/Prices.git
$ cd Prices
$ composer install
```

## Unit tests

Either copy `phpunit.xml.dist` to `phpunit.xml` and adapt to your needs, or leave as is. Run [PhpUnit](https://phpunit.de/) test or composer scripts like this:

```bash
$ composer test
# or
$ vendor/bin/phpunit
```

