# Playground: CRM API

[![Playground CI Workflow](https://github.com/gammamatrix/playground-crm-api/actions/workflows/ci.yml/badge.svg?branch=develop)](https://raw.githubusercontent.com/gammamatrix/playground-crm-api/testing/develop/testdox.txt)
[![Test Coverage](https://raw.githubusercontent.com/gammamatrix/playground-crm-api/testing/develop/coverage.svg)](tests)
[![PHPStan Level 9](https://img.shields.io/badge/PHPStan-level%209-brightgreen)](.github/workflows/ci.yml#L120)

The Playground: CRM API package.

## Documentation

### Swagger

This application provides Swagger documentation: [swagger.json](swagger.json).
- The endpoint models support locks, trash with force delete, restoring, revisions and more.
- Index endpoints support advanced query filtering.

Swagger API Documentation is built with npm.
- npm is only needed to generate documentation and is not needed to operate the CMS API.

See [package.json](package.json) requirements.

Install npm.

```sh
npm install
```

Build the documentation to generate the [swagger.json](swagger.json) configuration.

```sh
npm run docs
```

Documentation
- Preview [swagger.json on the Swagger Editor UI.](https://editor.swagger.io/?url=https://raw.githubusercontent.com/gammamatrix/playground-crm-api/develop/swagger.json)
- Preview [swagger.json on the Redocly Editor UI.](https://redocly.github.io/redoc/?url=https://raw.githubusercontent.com/gammamatrix/playground-crm-api/develop/swagger.json)

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
php artisan vendor:publish --provider=Playground\Crm\Api\ServiceProvider" --tag="playground-config"
```

## Cloc

```sh
composer cloc
```

```
➜  playground-crm-api git:(develop) ✗ composer cloc
> cloc --exclude-dir=node_modules,output,vendor .
     316 text files.
     228 unique files.
      89 files ignored.

github.com/AlDanial/cloc v 1.98  T=0.33 s (688.1 files/s, 103018.7 lines/s)
-------------------------------------------------------------------------------
Language                     files          blank        comment           code
-------------------------------------------------------------------------------
JSON                             5              0              0          18356
PHP                            154           1179           1945           6795
YAML                            62              5              0           5495
XML                              3              0              7            215
Markdown                         3             37              0             85
INI                              1              3              0             12
-------------------------------------------------------------------------------
SUM:                           228           1224           1952          30958
-------------------------------------------------------------------------------
```

## PHPStan

Tests at level 9 on:
- `config/`
- `lang/`
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

```sh
composer test --parallel
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
