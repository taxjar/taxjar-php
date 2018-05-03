# TaxJar Sales Tax API for PHP [![Packagist](https://img.shields.io/packagist/v/taxjar/taxjar-php.svg)](https://packagist.org/packages/taxjar/taxjar-php) [![Build Status](http://img.shields.io/travis/taxjar/taxjar-php.svg?style=flat-square)](https://travis-ci.org/taxjar/taxjar-php)

Official PHP client for Sales Tax API v2. For the REST documentation, please visit [http://developers.taxjar.com/api](http://developers.taxjar.com/api).

## Requirements

- PHP 5.5.0 and later.
- [Guzzle](https://github.com/guzzle/guzzle) (included via Composer).

## Installation

Use Composer and add `taxjar-php` as a dependency:

```
composer require taxjar/taxjar-php
```

```json
{
  "require": {
    "taxjar/taxjar-php": "^1.7"
  }
}
```

If you get an error with `composer require`, update your `composer.json` directly and run `composer update`.

## Authentication

```php
require __DIR__ . '/vendor/autoload.php';
$client = TaxJar\Client::withApiKey($_ENV['TAXJAR_API_KEY']);
```

## Usage

### List all tax categories

```php
$categories = $client->categories();
```

### List tax rates for a location (by zip/postal code)

```php
$rates = $client->ratesForLocation(90002, [
  'city' => 'LOS ANGELES',
  'country' => 'US'
]);

echo $rates->combined_rate;
// 0.09
```

### Calculate sales tax for an order

```php
$order_taxes = $client->taxForOrder([
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
$orders = $client->listOrders([
  'from_transaction_date' => '2014/01/01',
  'to_transaction_date' => '2015/05/30'
]);
```

### Show order transaction

```php
$order = $client->showOrder('123');
```

### Create order transaction

```php
$order = $client->createOrder([
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
$order = $client->updateOrder([
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
$client->deleteOrder('123');
```

### List refund transactions

```php
$refunds = $client->listRefunds([
  'from_transaction_date' => '2014/01/01',
  'to_transaction_date' => '2015/05/30'
]);
```

### Show refund transaction

```php
$refund = $client->showRefund('321');
```

### Create refund transaction

```php
$refund = $client->createRefund([
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
$refund = $client->updateRefund([
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
$client->deleteRefund('321');
```

### List customers

```php
$customers = $client->listCustomers();
```

### Show customer

```php
$customer = $client->showCustomer('123');
```

### Create customer

```php
$customer = $client->createCustomer([
  'customer_id' => '123',
  'exemption_type' => 'wholesale',
  'name' => 'Dunder Mifflin Paper Company',
  'exempt_regions' => [
    [
      'country' => 'US',
      'state' => 'FL'
    ],
    [
      'country' => 'US',
      'state' => 'PA'
    ]
  ],
  'country' => 'US',
  'state' => 'PA',
  'zip' => '18504',
  'city' => 'Scranton',
  'street' => '1725 Slough Avenue'
]);
```

### Update customer

```php
$customer = $client->updateCustomer([
  'customer_id' => '123',
  'exemption_type' => 'wholesale',
  'name' => 'Sterling Cooper',
  'exempt_regions' => [
    [
      'country' => 'US',
      'state' => 'NY'
    ]
  ],
  'country' => 'US',
  'state' => 'NY',
  'zip' => '10010',
  'city' => 'New York',
  'street' => '405 Madison Ave'
]);
```

### Delete customer

```php
$client->deleteCustomer('123');
```

### List nexus regions

```php
$nexus_regions = $client->nexusRegions();
```

### Validate a VAT number

```php
$validation = $client->validate([
  'vat' => 'FR40303265045'
]);
```

### Summarize tax rates for all regions

```php
$summarized_rates = $client->summaryRates();
```

## Sandbox Environment

You can easily configure the client to use the [TaxJar Sandbox](https://developers.taxjar.com/api/reference/#sandbox-environment):

```php
require __DIR__ . '/vendor/autoload.php';
$client = TaxJar\Client::withApiKey($_ENV['TAXJAR_SANDBOX_API_KEY']);
$client->setApiConfig('api_url', TaxJar\Client::SANDBOX_API_URL);
```

For testing specific [error response codes](https://developers.taxjar.com/api/reference/#errors), pass the custom `X-TJ-Expected-Response` header:

```php
$client->setApiConfig('headers', [
  'X-TJ-Expected-Response' => 422
]);
```

## Error Handling

When invalid data is sent to TaxJar or we encounter an error, we’ll throw a `TaxJar\Exception` with the HTTP status code and error message. To catch these exceptions, refer to the example below:

```php
require __DIR__ . '/vendor/autoload.php';
$client = TaxJar\Client::withApiKey($_ENV['TAXJAR_API_KEY']);

try {
  // Invalid request
  $order = $client->createOrder([
    'transaction_date' => '2015/05/14',
    'to_country' => 'US',
    'to_zip' => '90002',
    'to_state' => 'CA',
    'amount' => 16.5,
    'shipping' => 1.5,
    'sales_tax' => 0.95
  ]);
} catch (TaxJar\Exception $e) {
  // 406 Not Acceptable – transaction_id is missing
  echo $e->getMessage();

  // 406
  echo $e->getStatusCode();
}
```

For a full list of error codes, [click here](https://developers.taxjar.com/api/reference/#errors).

## Testing

Make sure PHPUnit is installed via `composer install` and run the following:

```
php vendor/bin/phpunit test/specs/.
```

To enable debug mode, set the following config parameter after authenticating:

```php
$client->setApiConfig('debug', true);
```
