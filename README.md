# TaxJar Sales Tax API for PHP [![Packagist](https://img.shields.io/packagist/v/taxjar/taxjar-php.svg)](https://packagist.org/packages/taxjar/taxjar-php) [![Build Status](http://img.shields.io/travis/taxjar/taxjar-php.svg?style=flat-square)](https://travis-ci.org/taxjar/taxjar-php)

Official PHP client for Sales Tax API v2. For the REST documentation, please visit [http://developers.taxjar.com/api](http://developers.taxjar.com/api).

## Requirements

- PHP 5.5.0 and later.
- [Guzzle](https://github.com/guzzle/guzzle) (included via Composer).

## Installation

Use Composer and add `taxjar-php` as a dependency:

```
"require": {
  "taxjar/taxjar-php": "*"
}
```

## Authentication

```php
$taxjar = TaxJar\Client::withApiKey($_ENV['TAXJAR_API_KEY']);
```

## Usage

### List all tax categories

```php
$categories = $taxjar->categories();
```

### List tax rates for a location (by zip/postal code)

```php
$rates = $taxjar->ratesForLocation(90002, [
  'city' => 'LOS ANGELES',
  'country' => 'US'
]);

echo $rates->combined_rate;
// 0.09
```

### Calculate sales tax for an order

```php
$order_taxes = $taxjar->taxForOrder([
  'from_country' => 'US',
  'from_zip' => '07001',
  'from_state' => 'NJ',
  'to_country' => 'US',
  'to_zip' => '07446',
  'to_state' => 'NJ',
  'amount' => 16.50,
  'shipping' => 1.5,
  'line_items' => [
    [
      'quantity' => 1,
      'unit_price' => 15.0,
      'product_tax_code' => 31000
    ]
  ]
]);

echo $order_taxes->amount_to_collect;
// 1.26
```

### List order transactions

```php
$orders = $taxjar->listOrders([
  'from_transaction_date' => '2014/01/01',
  'to_transaction_date' => '2015/05/30'
]);
```

### Show order transaction

```php
$order = $taxjar->showOrder('123');
```

### Create order transaction

```php
$order = $taxjar->createOrder([
  'transaction_id' => '123',
  'transaction_date' => '2015/05/14',
  'to_country' => 'US',
  'to_zip' => '90002',
  'to_state' => 'CA',
  'to_city' => 'Los Angeles',
  'to_street' => '123 Palm Grove Ln',
  'amount' => 17.45,
  'shipping' => 1.5,
  'sales_tax' => 0.95,
  'line_items' => [
    [
      'quantity' => 1,
      'product_identifier' => '12-34243-9',
      'description' => 'Fuzzy Widget',
      'unit_price' => 15.0,
      'sales_tax' => 0.95
    ]
  ]
]);
```

### Update order transaction

```php
$order = $taxjar->updateOrder([
  'transaction_id' => '123',
  'amount' => 17.95,
  'shipping' => 2.0,
  'line_items' => [
    [
      'quantity' => 1,
      'product_identifier' => '12-34243-0',
      'description' => 'Heavy Widget',
      'unit_price' => 15.0,
      'discount' => 0.0,
      'sales_tax' => 0.95
    ]
  ]
]);
```

### Delete order transaction

```php
$taxjar->deleteOrder('123');
```

### List refund transactions

```php
$refunds = $taxjar->listRefunds([
  'from_transaction_date' => '2014/01/01',
  'to_transaction_date' => '2015/05/30'
]);
```

### Show refund transaction

```php
$refund = $taxjar->showRefund('321');
```

### Create refund transaction

```php
$refund = $taxjar->createRefund([
  'transaction_id' => '321',
  'transaction_date' => '2015/05/14',
  'transaction_reference_id' => '123',
  'to_country' => 'US',
  'to_zip' => '90002',
  'to_state' => 'CA',
  'to_city' => 'Los Angeles',
  'to_street' => '123 Palm Grove Ln',
  'amount' => 17.45,
  'shipping' => 1.5,
  'sales_tax' => 0.95,
  'line_items' => [
    [
      'quantity' => 1,
      'product_identifier' => '12-34243-9',
      'description' => 'Fuzzy Widget',
      'unit_price' => 15.0,
      'sales_tax' => 0.95
    ]
  ]
]);
```

### Update refund transaction

```php
$refund = $taxjar->updateRefund([
  'transaction_id' => '321',
  'amount' => 17.95,
  'shipping' => 2.0,
  'line_items' => [
    [
      'quantity' => 1,
      'product_identifier' => '12-34243-0',
      'description' => 'Heavy Widget',
      'unit_price' => 15.0,
      'sales_tax' => 0.95
    ]
  ]
]);
```

### Delete refund transaction

```php
$taxjar->deleteRefund('321');
```

### Validate a VAT number

```php
$validation = $taxjar->validate([
  'vat' => 'FR40303265045'
]);
```

### Summarize tax rates for all regions

```php
$summarized_rates = $taxjar->summaryRates();
```

## Testing

Make sure PHPUnit is installed via `composer install` and run the following:

```
php vendor/bin/phpunit test/specs/.
```

To enable debug mode, set the following config parameter after authenticating:

```php
$taxjar->setApiConfig('debug', true);
```