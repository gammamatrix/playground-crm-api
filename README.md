# Playground: CRM API

[![Playground CI Workflow](https://github.com/gammamatrix/playground-crm-api/actions/workflows/ci.yml/badge.svg?branch=develop)](https://raw.githubusercontent.com/gammamatrix/playground-crm-api/testing/develop/testdox.txt)
[![Test Coverage](https://raw.githubusercontent.com/gammamatrix/playground-crm-api/testing/develop/coverage.svg)](tests)
[![PHPStan Level 10](https://img.shields.io/badge/PHPStan-level%2010-brightgreen)](.github/workflows/ci.yml#L128)

Playground: CRM API

This package provides an API without UI for interacting with the [Playground: CRM](https://github.com/gammamatrix/playground-crm), a model package for Laravel.

If you need a JSON API with a UI, then have a look at [Playground: CRM Resource.](https://github.com/gammamatrix/playground-crm-resource)

## Documentation

Read more on using [Playground: CRM API at Read the Docs: Playground Documentation](https://gammamatrix-playground.readthedocs.io/en/develop/built-components/crm.html)

### Postman

A postman collection is provided in the repository: [postman-playground-crm-api.json.](postman-playground-crm-api.json)
- This same collection is viewable on the [.]()

### OpenAPI

This application provides OpenAPI documentation: [openapi.yaml](openapi.yaml).
- The endpoint models support locks, trash with force delete, restoring, revisions and more.
- Index endpoints support advanced query filtering.

OpenAPI API Documentation is built with npm using Redocly.
- npm is only needed to generate documentation and is not needed to operate the Playground: CRM API API.

See [package.json](package.json) requirements.

Install npm.

```shell
npm install
```

Build the documentation to generate the [openapi.yaml](openapi.yaml) configuration.

```shell
npm run docs
```

Documentation
- Preview [openapi.yaml on the Redocly Editor UI.](https://redocly.github.io/redoc/?url=https://raw.githubusercontent.com/gammamatrix/playground-crm-api/develop/openapi.yaml)

## Installation

You can install the package via composer:

```shell
composer require gammamatrix/playground-crm-api
```

## `artisan about`

Playground provides information in the `artisan about` command.

<!-- <img src="resources/docs/artisan-about-playground-crm-api.png" alt="screenshot of artisan about command with Playground: CRM API."> -->

## Configuration

You can publish the config file with:

```shell
php artisan vendor:publish --provider="Playground\Crm\Api\ServiceProvider" --tag="playground-config"
```

All routes are enabled by default. They may be disabled via environment variable or the configuration.

See the contents of the published config file: [config/playground-crm-api.php](config/playground-crm-api.php)

You can publish the routes file with:
```shell
php artisan vendor:publish --provider="Playground\Crm\Api\ServiceProvider" --tag="playground-routes"
```
- The routes while be published in a folder at `routes/playground-crm-api`

### Environment Variables

If you are unable or do not want to publish [configuration files for this package](config/playground-crm-api.php),
you may override the options via system environment variables.

Information on [environment variables is available on the wiki for this package](https://github.com/gammamatrix/playground-crm-api/wiki/Environment-Variables)

## Migrations

This package requires the migrations in [playground-crm](https://github.com/gammamatrix/playground-crm) a Laravel package.

## Cloc

```shell
composer cloc
```

```terminaloutput
➜  playground-crm-api git:(develop) ✗ composer cloc
      0 text files.
      0 unique files.
      0 files ignored.

github.com/AlDanial/cloc v 1.98  T=0.0 s (0.0 files/s, 0.0 lines/s)
-------------------------------------------------------------------------------
Language                     files          blank        comment           code
-------------------------------------------------------------------------------
JSON                             0              0              0              0
PHP                              0              0              0              0
YAML                             0              0              0              0
XML                              0              0              0              0
Markdown                         0              0              0              0
INI                              0              0              0              0
-------------------------------------------------------------------------------
SUM:                             0              0              0              0
-------------------------------------------------------------------------------
```

## PHPStan

Tests at level 10 on:
- `config/`
- `routes/`
- `src/`
- `tests/Feature/`
- `tests/Unit/`

```shell
composer analyse
```

## Coding Standards

```shell
composer format
```

## Testing

Run unit tests:
```shell
composer test
```

Run unit and feature tests:
```shell
composer test-dev
```

Run unit and feature tests in parallel:
```shell
composer test-parallel
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
