<p align="center">
  <img src="https://hsto.org/webt/0v/qb/0p/0vqb0pp6ntyyd8mbdkkj0wsllwo.png" alt="Laravel" width="70" height="70" />
</p>

# Additional providers for [fzaninotto/faker][faker]

[![Version][badge_packagist_version]][link_packagist]
[![PHP Version][badge_php_version]][link_packagist]
[![Build Status][badge_build_status]][link_build_status]
[![Coverage][badge_coverage]][link_coverage]
[![Downloads count][badge_downloads_count]][link_packagist]
[![License][badge_license]][link_license]

This package provides set of additional providers for [faker][faker] package. Also it provides service-provider for Laravel framework.

## Install

Require this package with composer using the following command:

```bash
$ composer require --dev avto-dev/faker-providers "^3.2"
```

> Installed `composer` is required ([how to install composer][getcomposer]).

> You need to fix the major version of package.

### Laravel integration

After installation you **can** "publish" configuration file (`./config/faker.php`) using next command:

```shell
$ ./artisan vendor:publish --provider="AvtoDev\FakerProviders\Frameworks\Laravel\ServiceProvider"
```

And add any additional faker providers in `./config/faker.php` configuration file, if you want.

## Usage

For providers using you must register them at first:

```php
<?php

use Faker\Generator as FakerGenerator;
use AvtoDev\FakerProviders\ExtendedFaker;

/** @var FakerGenerator|ExtendedFaker $faker */
$faker    = new FakerGenerator;
$provider = \AvtoDev\FakerProviders\Providers\Cars\MarkAndModelProvider::class;
$faker->addProvider(new $provider($faker));

echo $faker->carMarkAndModel; // BMW X3
```

If you use this package in laravel application - all providers will be registered automatically. Then you can use all provided methods, for example, in model factory:

```php
<?php // File: ./database/factories/CarFactory.php

use App\Models\Car;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

/** @var EloquentFactory $factory */
$factory->define(Car::class, function (Faker $faker) {
    /** @var Faker|\AvtoDev\FakerProviders\ExtendedFaker $faker */
    return [
        'vin'   => $faker->vinCode,
        'mark'  => $mark = $faker->carMark,
        'model' => $faker->carModel($mark),
    ];
});
```

> Comment `/** @var \Faker\Generator|\AvtoDev\FakerProviders\ExtendedFaker $faker */` is required for correct type-hinting

## Providers

All providers located in `AvtoDev\FakerProviders\Providers` namespace.

### `Cars\MarkAndModelProvider`

```php
<?php /** @var \Faker\Generator|\AvtoDev\FakerProviders\ExtendedFaker $faker */

$faker->carMarkAndModel;   // Skoda Octavia
$faker->carMark;           // Daewoo
$faker->carModel;          // Juke
$faker->carModel('Honda'); // Civic Type R
$faker->carGeneration;     // IV Restyling
```

### `Identifiers\BodyProvider`

```php
<?php /** @var \Faker\Generator|\AvtoDev\FakerProviders\ExtendedFaker $faker */

$faker->bodyCode;        // ILМ842 6262494
$faker->invalidBodyCode; // 246553
```

### `Identifiers\ChassisProvider`

```php
<?php /** @var \Faker\Generator|\AvtoDev\FakerProviders\ExtendedFaker $faker */

$faker->chassisCode;        // СM3654637018
$faker->invalidChassisCode; // 20567820000000000
```

### `Identifiers\GrzProvider`

```php
<?php /** @var \Faker\Generator|\AvtoDev\FakerProviders\ExtendedFaker $faker */

$faker->grzCode;        // Х133АМ02
$faker->invalidGrzCode; // У777
```

### `Identifiers\PtsProvider`

```php
<?php /** @var \Faker\Generator|\AvtoDev\FakerProviders\ExtendedFaker $faker */

$faker->ptsCode;        // 80 30 518523
$faker->invalidPtsCode; // 67ОМ3760020
```

### `Identifiers\StsProvider`

```php
<?php /** @var \Faker\Generator|\AvtoDev\FakerProviders\ExtendedFaker $faker */

$faker->stsCode;        // 98РА409963
$faker->invalidStsCode; // 47 77 6580290
```

### `Identifiers\VinProvider`

```php
<?php /** @var \Faker\Generator|\AvtoDev\FakerProviders\ExtendedFaker $faker */

$faker->vinCode;        // LPFT634A62NV25411
$faker->invalidVinCode; // 728GY9PAGGSH443220
```

### `Identifiers\DriverLicenseNumberProvider`

```php
<?php /** @var \Faker\Generator|\AvtoDev\FakerProviders\ExtendedFaker $faker */

$faker->driverLicenseNumber;        // 66 ВС 167633
$faker->invalidDriverLicenseNumber; // 6802О3
```

### `Identifiers\InnAndKppProvider`

```php
<?php /** @var \Faker\Generator|\AvtoDev\FakerProviders\ExtendedFaker $faker */

$faker->innCode();        // 6449013711 500100732259
$faker->shortInnCode();   // 3664069397
$faker->longInnCode();    // 500100732259
$faker->validInnCode();   // 6449013711
$faker->invalidInnCode(); // 6449013712
$faker->kppCode();        // 644901371
$faker->validKppCode();   // 773301001 7733AZ001
$faker->invalidKppCode(); // 7733010011 77330100Z
```

### `Identifiers\CadastralNumberProvider`

```php
<?php /** @var \Faker\Generator|\AvtoDev\FakerProviders\ExtendedFaker $faker */

$faker->cadastralNumber();        // 66:41:153222:68
$faker->validCadastralNumber();   // 77:22:5874698:1
$faker->invalidCadastralNumber(); // 879:404:313:446
```

### `Packages\IDEntityProvider`

> Package [avto-dev/identity-laravel][identity] is required for this.

```php
<?php /** @var \Faker\Generator|\AvtoDev\FakerProviders\ExtendedFaker $faker */

$faker->idEntity('VIN'); // object:TypedIDEntityInterface (type 'VIN')
$faker->idEntity;        // object:TypedIDEntityInterface (random type)
```

### `User\AvatarUriProvider`

```php
<?php /** @var \Faker\Generator|\AvtoDev\FakerProviders\ExtendedFaker $faker */

$faker->userAvatarUri('Bill Gates', 200, 200); // Link to the some user avatar
```

> Examples:
>
> ![](https://images.weserv.nl/?url=i.pravatar.cc/103?u=14d71035552fef7c92e4b5c611232830&w=50&h=50&t=square)
> ![](https://images.weserv.nl/?url=i.pravatar.cc/140?u=f7827bf44040a444ac855cd67adfb502&w=50&h=50&t=square)
> ![](https://images.weserv.nl/?url=i.pravatar.cc/191?u=40cd750bba9870f18aada2478b24840a&w=50&h=50&t=square)
> ![](https://images.weserv.nl/?url=i.pravatar.cc/170?u=89fefb193877ee62e29d1da5975dcc47&w=50&h=50&t=square)


### Testing

For package testing we use `phpunit` framework and `docker-ce` + `docker-compose` as develop environment. So, just write into your terminal after repository cloning:

```bash
$ make build
$ make latest # or 'make lowest'
$ make test
```

## Changes log

[![Release date][badge_release_date]][link_releases]
[![Commits since latest release][badge_commits_since_release]][link_commits]

Changes log can be [found here][link_changes_log].

## Support

[![Issues][badge_issues]][link_issues]
[![Issues][badge_pulls]][link_pulls]

If you will find any package errors, please, [make an issue][link_create_issue] in current repository.

## License

This is open-sourced software licensed under the [MIT License][link_license].

[badge_packagist_version]:https://img.shields.io/packagist/v/avto-dev/faker-providers.svg?maxAge=180
[badge_php_version]:https://img.shields.io/packagist/php-v/avto-dev/faker-providers.svg?longCache=true
[badge_build_status]:https://img.shields.io/github/workflow/status/avto-dev/faker-providers/tests/master
[badge_coverage]:https://img.shields.io/codecov/c/github/avto-dev/faker-providers/master.svg?maxAge=60
[badge_downloads_count]:https://img.shields.io/packagist/dt/avto-dev/faker-providers.svg?maxAge=180
[badge_license]:https://img.shields.io/packagist/l/avto-dev/faker-providers.svg?longCache=true
[badge_release_date]:https://img.shields.io/github/release-date/avto-dev/faker-providers.svg?style=flat-square&maxAge=180
[badge_commits_since_release]:https://img.shields.io/github/commits-since/avto-dev/faker-providers/latest.svg?style=flat-square&maxAge=180
[badge_issues]:https://img.shields.io/github/issues/avto-dev/faker-providers.svg?style=flat-square&maxAge=180
[badge_pulls]:https://img.shields.io/github/issues-pr/avto-dev/faker-providers.svg?style=flat-square&maxAge=180
[link_releases]:https://github.com/avto-dev/faker-providers/releases
[link_packagist]:https://packagist.org/packages/avto-dev/faker-providers
[link_build_status]:https://github.com/avto-dev/faker-providers/actions
[link_coverage]:https://codecov.io/gh/avto-dev/faker-providers/
[link_changes_log]:https://github.com/avto-dev/faker-providers/blob/master/CHANGELOG.md
[link_issues]:https://github.com/avto-dev/faker-providers/issues
[link_create_issue]:https://github.com/avto-dev/faker-providers/issues/new/choose
[link_commits]:https://github.com/avto-dev/faker-providers/commits
[link_pulls]:https://github.com/avto-dev/faker-providers/pulls
[link_license]:https://github.com/avto-dev/faker-providers/blob/master/LICENSE
[getcomposer]:https://getcomposer.org/download/
[faker]:https://github.com/fzaninotto/Faker
[identity]:https://github.com/avto-dev/identity-laravel
