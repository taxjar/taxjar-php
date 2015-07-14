# TaxJar Sales Tax API for PHP

Official PHP client for Sales Tax API v2. For the REST documentation, please visit [http://developers.taxjar.com/api](http://developers.taxjar.com/api).

## Requirements

- PHP 5.3.3 and later.
- PHP [cURL extension](http://php.net/manual/en/book.curl.php)

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
  'shipping' => 1.5
]);

echo $order_taxes->amount_to_collect;
// 1.26
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

*Note: These examples use short syntax for arrays (PHP 5.4).*

## Testing

Working on it :-)