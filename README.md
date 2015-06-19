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

## Usage

Authenticating with the **Standard** API library:

```php
$taxjar = TaxJar\Standard::withApiKey(YOUR_API_KEY);
```

Authenticating with the **Enhanced** API library:

```php
$taxjar = TaxJar\Enhanced::withApiKey(YOUR_API_KEY);
```

## Examples

Get sales tax rates for a given location:

```php
$rates = $taxjar->getLocationRates(90002, [
  'city' => 'LOS ANGELES',
  'country' => 'US'
]);

echo $rates->combined_rate;
// 0.09
```

Get sales tax that should be collected for a given order:

```php
$order_taxes = $taxjar->getOrderTaxes([
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

*Note: These examples use short syntax for arrays (PHP 5.4).*

### Enhanced Endpoints

Get all tax categories:

```php
$tax_categories = $taxjar->getTaxCategories();
```

Create a new order:

```php
$response = $taxjar->createOrder([]);
```

Update an existing order:

```php
$response = $taxjar->updateOrder([]);
```

Create a new refund:

```php
$response = $taxjar->createRefund([]);
```

Update an existing refund:

```php
$response = $taxjar->updateRefund([]);
```

## Testing

Working on it :-)