# TaxJar Sales Tax API for PHP [![Packagist](https://img.shields.io/packagist/v/taxjar/taxjar-php.svg)](https://packagist.org/packages/taxjar/taxjar-php) [![Build Status](https://img.shields.io/travis/taxjar/taxjar-php.svg?style=flat-square)](https://travis-ci.org/taxjar/taxjar-php)

Official PHP client for Sales Tax API v2. For the REST documentation, please visit [https://developers.taxjar.com/api](https://developers.taxjar.com/api/reference/?php).

<hr>

[Requirements](#requirements)<br>
[Installation](#installation)<br>
[Authentication](#authentication)<br>
[Usage](#usage)<br>
[Custom Options](#custom-options)<br>
[Sandbox Environment](#sandbox-environment)<br>
[Error Handling](#error-handling)<br>
[Testing](#testing)

<hr>

## Requirements

- PHP 8.0 and later.
- [Guzzle](https://github.com/guzzle/guzzle) (included via Composer).

## Installation

Use Composer and add `taxjar-php` as a dependency:

```
composer require taxjar/taxjar-php
```

```json
{
  "require": {
    "taxjar/taxjar-php": "^2.0"
  }
}
```

If you get an error with `composer require`, update your `composer.json` directly and run `composer update`.

## Authentication

```php
require __DIR__ . '/vendor/autoload.php';
$client = TaxJar\Client::withApiKey($_ENV['TAXJAR_API_KEY']);
```

You're now ready to use TaxJar! [Check out our quickstart guide](https://developers.taxjar.com/api/guides/php/#php-quickstart) to get up and running quickly.

## Usage

[`categories` - List all tax categories](#list-all-tax-categories-api-docs)<br>
[`taxForOrder` - Calculate sales tax for an order](#calculate-sales-tax-for-an-order-api-docs)<br>
[`listOrders` - List order transactions](#list-order-transactions-api-docs)<br>
[`showOrder` - Show order transaction](#show-order-transaction-api-docs)<br>
[`createOrder` - Create order transaction](#create-order-transaction-api-docs)<br>
[`updateOrder` - Update order transaction](#update-order-transaction-api-docs)<br>
[`deleteOrder` - Delete order transaction](#delete-order-transaction-api-docs)<br>
[`listRefunds` - List refund transactions](#list-refund-transactions-api-docs)<br>
[`showRefund` - Show refund transaction](#show-refund-transaction-api-docs)<br>
[`createRefund` - Create refund transaction](#create-refund-transaction-api-docs)<br>
[`updateRefund` - Update refund transaction](#update-refund-transaction-api-docs)<br>
[`deleteRefund` - Delete refund transaction](#delete-refund-transaction-api-docs)<br>
[`listCustomers` - List customers](#list-customers-api-docs)<br>
[`showCustomer` - Show customer](#show-customer-api-docs)<br>
[`createCustomer` - Create customer](#create-customer-api-docs)<br>
[`updateCustomer` - Update customer](#update-customer-api-docs)<br>
[`deleteCustomer` - Delete customer](#delete-customer-api-docs)<br>
[`ratesForLocation` - List tax rates for a location (by zip/postal code)](#list-tax-rates-for-a-location-by-zippostal-code-api-docs)<br>
[`nexusRegions` - List nexus regions](#list-nexus-regions-api-docs)<br>
[`validateAddress` - Validate an address](#validate-an-address-api-docs)<br>
[`validate` - Validate a VAT number](#validate-a-vat-number-api-docs)<br>
[`summaryRates` - Summarize tax rates for all regions](#summarize-tax-rates-for-all-regions-api-docs)

<hr>

### List all tax categories <small>_([API docs](https://developers.taxjar.com/api/reference/?php#get-list-tax-categories))_</small>

> The TaxJar API provides product-level tax rules for a subset of product categories. These categories are to be used for products that are either exempt from sales tax in some jurisdictions or are taxed at reduced rates. You need not pass in a product tax code for sales tax calculations on product that is fully taxable. Simply leave that parameter out.

```php
$categories = $client->categories();
```

### Calculate sales tax for an order <small>_([API docs](https://developers.taxjar.com/api/reference/?php#post-calculate-sales-tax-for-an-order))_</small>

> Shows the sales tax that should be collected for a given order.

```php
$order_taxes = $client->taxForOrder([
  'from_country' => 'US',
  'from_zip' => '07001',
  'from_state' => 'NJ',
  'from_city' => 'Avenel',
  'from_street' => '305 W Village Dr',
  'to_country' => 'US',
  'to_zip' => '07446',
  'to_state' => 'NJ',
  'to_city' => 'Ramsey',
  'to_street' => '63 W Main St',
  'amount' => 16.50,
  'shipping' => 1.5,
  'line_items' => [
    [
      'id' => '1',
      'quantity' => 1,
      'product_tax_code' => '31000',
      'unit_price' => 15.0,
      'discount' => 0
    ]
  ]
]);

echo $order_taxes->amount_to_collect;
// 1.26
```

### List order transactions <small>_([API docs](https://developers.taxjar.com/api/reference/?php#get-list-order-transactions))_</small>

> Lists existing order transactions created through the API.

```php
$orders = $client->listOrders([
  'from_transaction_date' => '2015/05/01',
  'to_transaction_date' => '2015/05/31'
]);
```

### Show order transaction <small>_([API docs](https://developers.taxjar.com/api/reference/?php#get-show-an-order-transaction))_</small>

> Shows an existing order transaction created through the API.

```php
$order = $client->showOrder('123');
```

### Create order transaction <small>_([API docs](https://developers.taxjar.com/api/reference/?php#post-create-an-order-transaction))_</small>

> Creates a new order transaction.

```php
$order = $client->createOrder([
  'transaction_id' => '123',
  'transaction_date' => '2015/05/14',
  'from_country' => 'US',
  'from_zip' => '92093',
  'from_state' => 'CA',
  'from_city' => 'La Jolla',
  'from_street' => '9500 Gilman Drive',
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
      'id' => '1',
      'quantity' => 1,
      'product_identifier' => '12-34243-9',
      'description' => 'Fuzzy Widget',
      'unit_price' => 15.0,
      'discount': 0,
      'sales_tax' => 0.95
    ]
  ]
]);
```

### Update order transaction <small>_([API docs](https://developers.taxjar.com/api/reference/?php#put-update-an-order-transaction))_</small>

> Updates an existing order transaction created through the API.

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

### Delete order transaction <small>_([API docs](https://developers.taxjar.com/api/reference/?php#delete-delete-an-order-transaction))_</small>

> Deletes an existing order transaction created through the API.

```php
$client->deleteOrder('123');
```

### List refund transactions <small>_([API docs](https://developers.taxjar.com/api/reference/?php#get-list-refund-transactions))_</small>

> Lists existing refund transactions created through the API.

```php
$refunds = $client->listRefunds([
  'from_transaction_date' => '2015/05/01',
  'to_transaction_date' => '2015/05/31'
]);
```

### Show refund transaction <small>_([API docs](https://developers.taxjar.com/api/reference/?php#get-show-a-refund-transaction))_</small>

> Shows an existing refund transaction created through the API.

```php
$refund = $client->showRefund('123-refund');
```

### Create refund transaction <small>_([API docs](https://developers.taxjar.com/api/reference/?php#post-create-a-refund-transaction))_</small>

> Creates a new refund transaction.

```php
$refund = $client->createRefund([
  'transaction_id' => '123-refund',
  'transaction_reference_id' => '123',
  'transaction_date' => '2015/05/14',
  'from_country' => 'US',
  'from_zip' => '92093',
  'from_state' => 'CA',
  'from_city' => 'La Jolla',
  'from_street' => '9500 Gilman Drive',
  'to_country' => 'US',
  'to_zip' => '90002',
  'to_state' => 'CA',
  'to_city' => 'Los Angeles',
  'to_street' => '123 Palm Grove Ln',
  'amount' => -17.45,
  'shipping' => -1.5,
  'sales_tax' => -0.95,
  'line_items' => [
    [
      'id' => '1',
      'quantity' => 1,
      'product_identifier' => '12-34243-9',
      'description' => 'Fuzzy Widget',
      'unit_price' => -15.0,
      'discount' => -0,
      'sales_tax' => -0.95
    ]
  ]
]);
```

### Update refund transaction <small>_([API docs](https://developers.taxjar.com/api/reference/?php#put-update-a-refund-transaction))_</small>

> Updates an existing refund transaction created through the API.

```php
$refund = $client->updateRefund([
  'transaction_id' => '123-refund',
  'transaction_reference_id' => '123',
  'amount' => -17.95,
  'shipping' => -2.0,
  'line_items' => [
    [
      'id' => '1',
      'quantity' => 1,
      'product_identifier' => '12-34243-0',
      'description' => 'Heavy Widget',
      'unit_price' => -15.0,
      'discount' => -0,
      'sales_tax' => -0.95
    ]
  ]
]);
```

### Delete refund transaction <small>_([API docs](https://developers.taxjar.com/api/reference/?php#delete-delete-a-refund-transaction))_</small>

> Deletes an existing refund transaction created through the API.

```php
$client->deleteRefund('123-refund');
```

### List customers <small>_([API docs](https://developers.taxjar.com/api/reference/?php#get-list-customers))_</small>

> Lists existing customers created through the API.

```php
$customers = $client->listCustomers();
```

### Show customer <small>_([API docs](https://developers.taxjar.com/api/reference/?php#get-show-a-customer))_</small>

> Shows an existing customer created through the API.

```php
$customer = $client->showCustomer('123');
```

### Create customer <small>_([API docs](https://developers.taxjar.com/api/reference/?php#post-create-a-customer))_</small>

> Creates a new customer.

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

### Update customer <small>_([API docs](https://developers.taxjar.com/api/reference/?php#put-update-a-customer))_</small>

> Updates an existing customer created through the API.

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

### Delete customer <small>_([API docs](https://developers.taxjar.com/api/reference/?php#delete-delete-a-customer))_</small>

> Deletes an existing customer created through the API.

```php
$client->deleteCustomer('123');
```

### List tax rates for a location (by zip/postal code) <small>_([API docs](https://developers.taxjar.com/api/reference/?php#get-show-tax-rates-for-a-location))_</small>

> Shows the sales tax rates for a given location.
>
> **Please note this method only returns the full combined rate for a given location.** It does not support nexus determination, sourcing based on a ship from and ship to address, shipping taxability, product exemptions, customer exemptions, or sales tax holidays. We recommend using [`taxForOrder` to accurately calculate sales tax for an order](#calculate-sales-tax-for-an-order-api-docs).

```php
$rates = $client->ratesForLocation(90002, [
  'city' => 'LOS ANGELES',
  'country' => 'US'
]);

echo $rates->combined_rate;
// 0.09
```

### List nexus regions <small>_([API docs](https://developers.taxjar.com/api/reference/?php#get-list-nexus-regions))_</small>

> Lists existing nexus locations for a TaxJar account.

```php
$nexus_regions = $client->nexusRegions();
```

### Validate an address <small>_([API docs](https://developers.taxjar.com/api/reference/?php#post-validate-an-address))_</small>

> Validates a customer address and returns back a collection of address matches. **Address validation requires a [TaxJar Plus](https://www.taxjar.com/plus/) subscription.**

```php
$addresses = $client->validateAddress([
  'country' => 'US',
  'state' => 'AZ',
  'zip' => '85297',
  'city' => 'Gilbert',
  'street' => '3301 South Greenfield Rd'
]);
```

### Validate a VAT number <small>_([API docs](https://developers.taxjar.com/api/reference/?php#get-validate-a-vat-number))_</small>

> Validates an existing VAT identification number against [VIES](http://ec.europa.eu/taxation_customs/vies/).

```php
$validation = $client->validate([
  'vat' => 'FR40303265045'
]);
```

### Summarize tax rates for all regions <small>_([API docs](https://developers.taxjar.com/api/reference/?php#get-summarize-tax-rates-for-all-regions))_</small>

> Retrieve minimum and average sales tax rates by region as a backup.
>
> This method is useful for periodically pulling down rates to use if the TaxJar API is unavailable. However, it does not support nexus determination, sourcing based on a ship from and ship to address, shipping taxability, product exemptions, customer exemptions, or sales tax holidays. We recommend using [`taxForOrder` to accurately calculate sales tax for an order](#calculate-sales-tax-for-an-order-api-docs).

```php
$summarized_rates = $client->summaryRates();
```

## Sandbox Environment

You can easily configure the client to use the [TaxJar Sandbox](https://developers.taxjar.com/api/reference/?php#sandbox-environment):

```php
require __DIR__ . '/vendor/autoload.php';
$client = TaxJar\Client::withApiKey($_ENV['TAXJAR_SANDBOX_API_KEY']);
$client->setApiConfig('api_url', TaxJar\Client::SANDBOX_API_URL);
```

For testing specific [error response codes](https://developers.taxjar.com/api/reference/?php#errors), pass the custom `X-TJ-Expected-Response` header:

```php
$client->setApiConfig('headers', [
  'X-TJ-Expected-Response' => 422
]);
```

## Custom Options

### Timeout
> This package utilizes Guzzle which defaults to a request timeout value of 0s, allowing requests to remain pending for an indefinite period of time.
>
> You can modify this behavior by configuring the client with a `timeout` value in seconds.
```php
$client->setApiConfig('timeout', 30);
```

### API Version
> By default, TaxJar's API will respond to requests with the [latest API version](https://developers.taxjar.com/api/reference/#changelog) when a version header is not present on the request.
>
> To request a specific API version, include the `x-api-version` header with the desired version string.
```php
$client->setApiConfig('headers', [
  'x-api-version' => '2020-08-07'
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
    'from_country' => 'US',
    'from_zip' => '07001',
    'from_state' => 'NJ',
    'from_city' => 'Avenel',
    'from_street' => '305 W Village Dr',
    'to_country' => 'US',
    'to_zip' => '90002',
    'to_state' => 'CA',
    'to_city' => 'Ramsey',
    'to_street' => '63 W Main St',
    'amount' => 16.5,
    'shipping' => 1.5,
    'sales_tax' => 0.95,
    'line_items' => [
      [
        'id' => '1',
        'quantity' => 1,
        'product_tax_code' => '31000',
        'unit_price' => 15,
        'discount' => 0,
        'sales_tax' => 0.95
      ]
    ]
  ]);
} catch (TaxJar\Exception $e) {
  // 406 Not Acceptable – transaction_id is missing
  echo $e->getMessage();

  // 406
  echo $e->getStatusCode();
}
```

For a full list of error codes, [click here](https://developers.taxjar.com/api/reference/?php#errors).

## Testing

Make sure PHPUnit is installed via `composer install` and run the following:

```
php vendor/bin/phpunit test/specs/.
```

To enable debug mode, set the following config parameter after authenticating:

```php
$client->setApiConfig('debug', true);
```
