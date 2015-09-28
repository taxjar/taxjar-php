# CHANGELOG

## 1.2.2 - 2015-09-28

* Bug fix: Use global namespace for exception when no API token is provided. Added new test.

## 1.2.1 - 2015-09-24

* Client now uses Guzzle for HTTP requests.
* Added PHPUnit specs for testing API methods.
* Improved JSON response handling for transaction requests.
* Feature: New utility methods `setApiConfig` and `getApiConfig` for managing Guzzle options (useful for testing).
* Note: If upgrading from v1.1.x, review your response handling for transactions. Order/refund methods now return the object directly inside the JSON response.

## 1.1.4 - 2015-09-24

* Bug fix: `updateOrder` and `updateRefund` transaction methods should not explicitly require `$transaction_id` as first argument. Corrected to only take a `$parameters` array as shown in the documentation.