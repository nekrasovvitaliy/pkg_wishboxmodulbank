# WishBox ModulBank

Joomla library package for creating payment links through ModulBank internet acquiring.

## Requirements

- PHP 8.5 or later with the cURL extension;
- Joomla 6.1.4 or later;
- Composer for development and tests;
- Phing for building the installable package.

## Usage

```php
use WishboxModulBankLibrary\Service\PaymentLinkCreationService;

$service = new PaymentLinkCreationService(timeout: 30);
$paymentUrl = $service->create($params);
```

The `$params` array must contain the fields required by the ModulBank bill creation API, including the merchant identifier and request signature.

## Tests

```shell
composer install
vendor/bin/phpunit
```

## Build

```shell
php phing-latest.phar
```

The command creates `pkg_wishboxmodulbank.zip`, which can be installed through the Joomla extension installer.
