# Product Core

!!! STILL IN ACTIVE DEVELOPMENT !!!

[![Build Status](https://travis-ci.org/RuffleLabs/ProductCore.svg?branch=develop)](https://travis-ci.org/RuffleLabs/ProductCore) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/RuffleLabs/ProductCore/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/RuffleLabs/ProductCore/?branch=master)

A laravel e-commerce package, to help manage your inventory.

## Installation

Require the `ruffle-labs/product-core` package from [Packagist](https://packagist.org/packages/ruffle-labs/product-core/)

```
composer require ruffle-labs/product-core
```

Add our core service provider to your `config/app.php` file

```
'providers' => [
  // ...
  RuffleLabs\ProductCore\Providers\CoreServiceProvider::class,
];
```
Add the aliases to your `config/app.php` file

```
'aliases' => [
  // ...
  'Catalogue' => RuffleLabs\ProductCore\Facades\Catalogue::class,
];
```

*Voila!*

## Usage

...In Progress

