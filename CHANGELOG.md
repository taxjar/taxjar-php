# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [2.0.0] - 2022-09-30
- Adds PHP 8.x support and drops support for PHP <= 7.x

## [1.10.4] - 2020-10-06
- Support Guzzle version 7 in composer.json.

## [1.10.3] - 2020-06-03
- Tweak error handling and provide default error messages

## [1.10.2] - 2020-06-02
- Fix issue where some error messages were masked by improper formatting

## [1.10.1] - 2020-04-02
- Fix issue with displaying current taxjar-php version in user agent

## [1.10.0] - 2020-03-26

- Include custom user agent for debugging and informational purposes

## [1.9.0] - 2019-09-30

- `showOrder`, `deleteOrder`, `showRefund`, and `deleteRefund` now accept an optional second parameter: `$parameters`.

## [1.8.1] - 2018-11-30

- Clean up exception handling and unblock `\Exception` codes.

## [1.8.0] - 2018-10-31

- Set up address validation method.

## [1.7.0] - 2018-05-03

- Set up customer exemption methods.
- Lock Silex dependency for HTTP Mock until Symfony issue resolved.

## [1.6.0] - 2018-05-03

- Set up customer exemption methods.
- Lock Silex dependency for HTTP Mock until Symfony issue resolved.

## [1.5.0] - 2017-06-20

- Pass error status code separately for improved exception handling.

## [1.4.0] - 2016-10-05

- Add new `/v2/nexus/regions` endpoint.
- Update DocBlock reference URLs.

## [1.3.1] - 2016-04-06

- Relax Guzzle version specificity in composer.json.

## [1.3.0] - 2016-03-04

- Add new `/v2/validation` and `/v2/summary_rates` endpoints.
- Update http-mock library.

## [1.2.4] - 2015-12-29

- Only throw exception for error status codes, not 201 responses.

## [1.2.3] - 2015-10-16

- Use custom response handler for catching Guzzle exceptions.
- Update PHP requirement in composer.json.

## [1.2.2] - 2015-09-28

- Bug fix: Use global namespace for exception when no API token is provided. Added new test.

## [1.2.1] - 2015-09-24

- Client now uses Guzzle for HTTP requests.
- Added PHPUnit specs for testing API methods.
- Improved JSON response handling for transaction requests.
- Feature: New utility methods `setApiConfig` and `getApiConfig` for managing Guzzle options (useful for testing).
- Note: If upgrading from v1.1.x, review your response handling for transactions. Order/refund methods now return the object directly inside the JSON response.

## [1.1.4] - 2015-09-24

- Bug fix: `updateOrder` and `updateRefund` transaction methods should not explicitly require `$transaction_id` as first argument. Corrected to only take a `$parameters` array as shown in the documentation.

## [1.1.3] - 2015-08-31

- `urlencode()` GET parameters to prevent `505 HTTP Version Not Supported` response.

## [1.1.2] - 2015-08-26

- Update `Client::withApiKey` to a public static method.

## [1.1.1] - 2015-08-18

- Pass request body as `application/json` for line items.

## [1.1.0] - 2015-07-28

- Add new transaction endpoints.
- Update DocBlock URLs.

## 1.0.0 - 2015-07-14

- Initial release.

[Unreleased]: https://github.com/taxjar/taxjar-php/compare/v2.0.0...HEAD
[2.0.0]: https://github.com/taxjar/taxjar-php/compare/v1.10.4...v2.0.0
[1.10.4]: https://github.com/taxjar/taxjar-php/compare/v1.10.3...v1.10.4
[1.10.3]: https://github.com/taxjar/taxjar-php/compare/v1.10.2...v1.10.3
[1.10.2]: https://github.com/taxjar/taxjar-php/compare/v1.10.1...v1.10.2
[1.10.1]: https://github.com/taxjar/taxjar-php/compare/v1.10.0...v1.10.1
[1.10.0]: https://github.com/taxjar/taxjar-php/compare/v1.9.0...v1.10.0
[1.9.0]: https://github.com/taxjar/taxjar-php/compare/v1.8.1...v1.9.0
[1.8.1]: https://github.com/taxjar/taxjar-php/compare/v1.8.0...v1.8.1
[1.8.0]: https://github.com/taxjar/taxjar-php/compare/v1.7.0...v1.8.0
[1.7.0]: https://github.com/taxjar/taxjar-php/compare/v1.6.0...v1.7.0
[1.6.0]: https://github.com/taxjar/taxjar-php/compare/v1.5.0...v1.6.0
[1.5.0]: https://github.com/taxjar/taxjar-php/compare/v1.4.0...v1.5.0
[1.4.0]: https://github.com/taxjar/taxjar-php/compare/v1.3.1...v1.4.0
[1.3.1]: https://github.com/taxjar/taxjar-php/compare/v1.3.0...v1.3.1
[1.3.0]: https://github.com/taxjar/taxjar-php/compare/v1.2.4...v1.3.0
[1.2.4]: https://github.com/taxjar/taxjar-php/compare/v1.2.3...v1.2.4
[1.2.3]: https://github.com/taxjar/taxjar-php/compare/v1.2.2...v1.2.3
[1.2.2]: https://github.com/taxjar/taxjar-php/compare/v1.2.1...v1.2.2
[1.2.1]: https://github.com/taxjar/taxjar-php/compare/v1.1.4...v1.2.1
[1.1.4]: https://github.com/taxjar/taxjar-php/compare/v1.1.3...v1.1.4
[1.1.3]: https://github.com/taxjar/taxjar-php/compare/v1.1.2...v1.1.3
[1.1.2]: https://github.com/taxjar/taxjar-php/compare/v1.1.1...v1.1.2
[1.1.1]: https://github.com/taxjar/taxjar-php/compare/v1.1.0...v1.1.1
[1.1.0]: https://github.com/taxjar/taxjar-php/compare/v1.0.0...v1.1.0
