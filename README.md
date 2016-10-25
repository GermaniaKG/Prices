#Germania\Prices

**This package was destilled from legacy code!**   
You better do not want it to use this in production.


##Installation

```bash
$ composer require germania-kg/prices
```

**MySQL:** This package requires a MySQL table *germania_prices* which you can install using `germania_prices.sql` in `sql/` directory.


##Usage

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


##Development and Testing

Develop using `develop` branch, using [Git Flow](https://github.com/nvie/gitflow).   
**Currently, no tests are specified.**

```bash
$ git clone git@github.com:GermaniaKG/Downloads.git germania-prices
$ cd germania-prices
$ cp phpunit.xml.dist phpunit.xml
$ phpunit
```
