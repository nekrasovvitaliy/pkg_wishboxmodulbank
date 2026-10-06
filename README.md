# WishBox ModulBank

Joomla library package for creating payment links through ModulBank internet acquiring.

The package installs the payment-link library and the `System - Wishbox ModulBank` plugin. The plugin stores the merchant identifier and test-mode setting used by Wishbox integrations.

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

After installation, open the Joomla plugin manager, find `System - Wishbox ModulBank`, and configure its merchant identifier and test mode. The package installer enables the plugin automatically on its first installation.

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
