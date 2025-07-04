# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog][keepachangelog] and this project adheres to [Semantic Versioning][semver].

## v3.9.0

### Added

- Laravel `12.x` support

### Changed

- Version of `composer` in `Dockerfile` updated up to `2.8.9`
- Update dev dependencies

## v3.8.0

### Changed

- Minimal valid length of chassis_code and body_code is 8 symbols
- Minimal `avto-dev/identity-laravel` version now is `5.9`
- Minimal `avto-dev/extended-laravel-validator` version now is `4.0`

## v3.7.0

### Added

- Laravel `11.x` support

### Changed

- Version of `composer` in docker container updated up to `2.7.6`
- Updated dev dependencies

## v3.6.0

### Changed

- Minimal PHP version now is `8.1`
- Minimal Laravel version now is `10.0`
- Minimal `fakerphp/faker` version now is `1.21`
- Minimal `avto-dev/extended-laravel-validator` version now is `3.7`
- Minimal `avto-dev/identity-laravel` version now is `5.7`
- Minimal `phpstan/phpstan` version now is `1.10`
- Minimal `phpunit/phpunit` version now is `10.5`
- Version of `composer` in docker container updated up to `2.6.6`

## v3.5.0

### Added

- Support Laravel `9.x`

### Changed

- Minimal required PHP version now is `7.3`

## v3.4.0

### Added

- Support PHP `8.x`

### Changed

- Composer `2.x` is supported now
- Maximal `illuminate/*` packages version now is `~8.0`
- Minimal `illuminate/*` packages version now is `~6.0`
- CI completely moved from "Travis CI" to "Github Actions" _(travis builds disabled)_
- Minimal required PHP version now is `7.2`
- Package `fzaninotto/faker` replaced with `fakerphp/faker` version `~1.12`

## v3.3.0

### Changed

- Maximal `illuminate/*` packages version now is `7.*`

## v3.2.0

### Changed

- Maximal `illuminate/*` packages version now is `~6.0`
- Minimal `illuminate/*` packages version now is `^5.5`
- Dev-dependencies `phpstan/phpstan` and `phpunit/phpunit` updated
- `styleci.io` rules
- Return type in methods _(where it possible)_

### Added

- GitHub Actions for a tests running
- PHP 7.4 support
- [Laravel] `Faker\Generator` registration as a singleton in service provider _(if it was not bound previously)_
- `avto-dev/identity-laravel` package version `^5.0` supports
- New region codes for `GrzProvider`

### Fixed

- Invalid cadastral number generation

## v3.1.0

### Added

- `CadastralNumberProvider` faker provider for random cadastral numbers

## v3.0.0

### Added

- Docker-based environment for development
- Project `Makefile`
- `declare(strict_types = 1)` into each class

### Changed

- Minimal `PHP` version now is `^7.1.3`
- Maximal `Laravel` version now is `5.8.x`
- Composer scripts
- **Method signatures in classes now type-hinted (where it possible)**

## v2.3.0

### Changed

- Maximal PHP version now is undefined
- CI changed to [Travis CI][travis]
- [CodeCov][codecov] integrated

[travis]:https://travis-ci.org/
[codecov]:https://codecov.io/

## v2.2.0

### Added

- `InnAndKppProvider` faker provider for random INN and KPP codes

## v2.1.0

### Added

- `AvatarUriProvider` faker provider for random avatars URI generation

### Changed

- Maximal laravel version now is `5.7` _(dev-dependency)_

## v2.0.0

### Changed

- Minimal `avto-dev/extended-laravel-validator` package version now is `2.0`
- Minimal `avto-dev/identity-laravel` package version now is `3.0`
- New `grz` code formats (based on GOST)

## v1.3.0

### Added

- Added `idEntity` method

### Fixed

- Fixed phpdoc annotations

### Changed

- Providers static methods now non-static

## v1.2.0

### Added

- Added `carGeneration` method

## v1.1.1

### Fixed

- Laravel configuration file comments updated

## v1.1.0

### Changed

- Code a little bit refactored

## v1.0.0

### Changed

- First release

[keepachangelog]:https://keepachangelog.com/en/1.0.0/
[semver]:https://semver.org/spec/v2.0.0.html
