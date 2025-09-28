# Playground: CRM API

[![Playground CI Workflow](https://github.com/gammamatrix/playground-crm-api/actions/workflows/ci.yml/badge.svg?branch=develop)](https://raw.githubusercontent.com/gammamatrix/playground-crm-api/testing/develop/testdox.txt)
[![Test Coverage](https://raw.githubusercontent.com/gammamatrix/playground-crm-api/testing/develop/coverage.svg)](tests)
[![PHPStan Level 10](https://img.shields.io/badge/PHPStan-level%2010-brightgreen)](.github/workflows/ci.yml#L128)

The Playground: CRM API package.

## Documentation

### OpenAPI

This application provides OpenAPI documentation: [openapi.yaml](openapi.yaml).
- The endpoint models support locks, trash with force delete, restoring, revisions and more.
- Index endpoints support advanced query filtering.

OpenAPI API Documentation is built with npm using Redocly.
- npm is only needed to generate documentation and is not needed to operate the Playground: CRM API API.

See [package.json](package.json) requirements.

Install npm.

```sh
npm install
```

Build the documentation to generate the [openapi.yaml](openapi.yaml) configuration.

```sh
npm run docs
```

Documentation
- Preview [openapi.yaml on the Redocly Editor UI.](https://redocly.github.io/redoc/?url=https://raw.githubusercontent.com/gammamatrix/playground-crm-api/develop/openapi.yaml)

## Installation

You can install the package via composer:

```bash
composer require gammamatrix/playground-crm-api
```

## Configuration

All options are disabled by default.

See the contents of the published config file: [config/playground-crm-api.php](config/playground-crm-api.php)

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Playground\Crm\Api\ServiceProvider" --tag="playground-config"
```

## Cloc

```sh
composer cloc
```

```
➜  playground-crm-api git:(develop) ✗ composer cloc
     388 text files.
     378 unique files.
      96 files ignored.

github.com/AlDanial/cloc v 2.06  T=0.13 s (2970.5 files/s, 333155.7 lines/s)
-------------------------------------------------------------------------------
Language                     files          blank        comment           code
-------------------------------------------------------------------------------
JSON                           157              0              0          20362
YAML                            54              5              0          11280
PHP                            153           1442           1941           6265
XML                             10              0              7            940
Markdown                         3             38              0            100
INI                              1              3              0             12
-------------------------------------------------------------------------------
SUM:                           378           1488           1948          38959
-------------------------------------------------------------------------------
```

## PHPStan

Tests at level 10 on:
- `config/`
- `routes/`
- `src/`
- `tests/Feature/`
- `tests/Unit/`

```sh
composer analyse
```

## Coding Standards

```sh
composer format
```

## Testing

Run unit tests:
```sh
composer test
```

Run unit and feature tests:
```sh
composer test-dev
```

Run unit and feature tests in parallel:
```sh
composer test-parallel
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
