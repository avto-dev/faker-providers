<p align="center">
  <img src="https://hsto.org/webt/0v/qb/0p/0vqb0pp6ntyyd8mbdkkj0wsllwo.png" alt="Laravel" width="70" height="70" />
</p>

# Провайдеры генераторов для пакета [faker][faker]

[![Version][badge_packagist_version]][link_packagist]
[![Version][badge_php_version]][link_packagist]
[![Build Status][badge_build_status]][link_build_status]
[![Coverage][badge_coverage]][link_coverage]
[![Code quality][badge_code_quality]][link_coverage]
[![Downloads count][badge_downloads_count]][link_packagist]
[![License][badge_license]][link_license]

Данный пакет поставляет набор дополнительных провайдеров, которые расширяют базовые возможности пакета [faker][faker]. Так же он содержит готовый сервис-провайдер для интеграции с фреймворком Laravel.

## Установка

Для установки данного пакета выполните в терминале следующую команду:

```shell
$ composer require --dev avto-dev/faker-providers "^2.0"
```

> Для этого необходим установленный `composer`. Для его установки перейдите по [данной ссылке][getcomposer].

> Обратите внимание на то, что необходимо фиксировать мажорную версию устанавливаемого пакета.

### Интеграция с Laravel

Если вы используете Laravel версии 5.5 и выше, то сервис-провайдер данного пакета будет зарегистрирован автоматически. В противном случае вам необходимо самостоятельно зарегистрировать сервис-провайдер в секции `providers` файла `./config/app.php`:

```php
'providers' => [
    // ...
    AvtoDev\FakerProviders\Frameworks\Laravel\ServiceProvider::class,
]
```

После этого "опубликуйте" конфигурационный файл:

```shell
$ php artisan vendor:publish --provider="AvtoDev\FakerProviders\Frameworks\Laravel\ServiceProvider"
```

И произведите необходимые настройки в файле  `./config/faker.php`. При помощи конфигурационного файла вы так же можете удобно подключать свои провайдеры для faker.

## Использование

Пакет поставляется с провайдерами, которые умеют:

- Государственный регистрационный номер (ГРЗ);
- VIN-код ТС (транспортного средства);
- Номер свидетельства о регистрации ТС (СТС);
- Номер паспорта ТС (ПТС);
- Номер кузова ТС;
- Номер шасси ТС;
- Номер водительского удостоверения;
- Марку и модель ТС;
- Объект IDEntity (необходима установка дополнительного пакета [avto-dev/identity-laravel][identity]).

Для использования того или иного провайдера вам необходимо его сперва загрузить:

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

Если же вы используете данный пакет с Laravel приложением, то все провайдеры загружаются автоматически. Пример использования:

```php
<?php // File: ./database/factories/CarFactory.php

use App\Models\Car;
use Faker\Generator as Faker;
use AvtoDev\FakerProviders\ExtendedFaker;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

/** @var EloquentFactory $factory */
$factory->define(Car::class, function (Faker $faker) {
    /** @var Faker|ExtendedFaker $faker */
    return [
        'vin'   => $faker->vinCode,
        'mark'  => $mark = $faker->carMark,
        'model' => $faker->carModel($mark),
    ];
});
```

> Конструкция `/** @var \Faker\Generator|\AvtoDev\FakerProviders\ExtendedFaker $faker */` необходима для корректного type-hinting в вашей IDE.

## Провайдеры

### `AvtoDev\FakerProviders\Providers\Cars\MarkAndModelProvider`

```php
<?php /** @var \Faker\Generator|\AvtoDev\FakerProviders\ExtendedFaker $faker */

$faker->carMarkAndModel;   // Skoda Octavia
$faker->carMark;           // Daewoo
$faker->carModel;          // Juke
$faker->carModel('Honda'); // Civic Type R
$faker->carGeneration;     // IV Restyling
```

### `AvtoDev\FakerProviders\Providers\Identifiers\BodyProvider`

```php
<?php /** @var \Faker\Generator|\AvtoDev\FakerProviders\ExtendedFaker $faker */

$faker->bodyCode;        // ILМ842 6262494
$faker->invalidBodyCode; // 246553
```

### `AvtoDev\FakerProviders\Providers\Identifiers\ChassisProvider`

```php
<?php /** @var \Faker\Generator|\AvtoDev\FakerProviders\ExtendedFaker $faker */

$faker->chassisCode;        // СM3654637018
$faker->invalidChassisCode; // 20567820000000000
```

### `AvtoDev\FakerProviders\Providers\Identifiers\GrzProvider`

```php
<?php /** @var \Faker\Generator|\AvtoDev\FakerProviders\ExtendedFaker $faker */

$faker->grzCode;        // Х133АМ02
$faker->invalidGrzCode; // У777
```

### `AvtoDev\FakerProviders\Providers\Identifiers\PtsProvider`

```php
<?php /** @var \Faker\Generator|\AvtoDev\FakerProviders\ExtendedFaker $faker */

$faker->ptsCode;        // 80 30 518523
$faker->invalidPtsCode; // 67ОМ3760020
```

### `AvtoDev\FakerProviders\Providers\Identifiers\StsProvider`

```php
<?php /** @var \Faker\Generator|\AvtoDev\FakerProviders\ExtendedFaker $faker */

$faker->stsCode;        // 98РА409963
$faker->invalidStsCode; // 47 77 6580290
```

### `AvtoDev\FakerProviders\Providers\Identifiers\VinProvider`

```php
<?php /** @var \Faker\Generator|\AvtoDev\FakerProviders\ExtendedFaker $faker */

$faker->vinCode;        // LPFT634A62NV25411
$faker->invalidVinCode; // 728GY9PAGGSH443220
```

### `AvtoDev\FakerProviders\Providers\Identifiers\DriverLicenseNumberProvider`

```php
<?php /** @var \Faker\Generator|\AvtoDev\FakerProviders\ExtendedFaker $faker */

$faker->driverLicenseNumber;        // 66 ВС 167633
$faker->invalidDriverLicenseNumber; // 6802О3
```

### `AvtoDev\FakerProviders\Providers\Packages\IDEntityProvider`

> Необходима установка дополнительного пакета [avto-dev/identity-laravel][identity].

```php
<?php /** @var \Faker\Generator|\AvtoDev\FakerProviders\ExtendedFaker $faker */

$faker->idEntity('VIN'); // object:TypedIDEntityInterface (type 'VIN')
$faker->idEntity;        // object:TypedIDEntityInterface (random type)
```

### `AvtoDev\FakerProviders\Providers\User\AvatarUriProvider`

```php
<?php /** @var \Faker\Generator|\AvtoDev\FakerProviders\ExtendedFaker $faker */

$faker->userAvatarUri(100);   // Link to user avatar
```


### Testing

For package testing we use `phpunit` framework. Just write into your terminal:

```shell
$ git clone git@github.com:avto-dev/faker-providers.git ./faker-providers && cd $_
$ composer install
$ composer test
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

[badge_packagist_version]:https://img.shields.io/packagist/v/avto-dev/faker-providers.svg?style=flat-square&maxAge=180
[badge_php_version]:https://img.shields.io/packagist/php-v/avto-dev/faker-providers.svg?style=flat-square&longCache=true
[badge_build_status]:https://img.shields.io/scrutinizer/build/g/avto-dev/faker-providers.svg?style=flat-square&maxAge=180&logo=scrutinizer
[badge_code_quality]:https://img.shields.io/scrutinizer/g/avto-dev/faker-providers.svg?style=flat-square&maxAge=180
[badge_coverage]:https://img.shields.io/scrutinizer/coverage/g/avto-dev/faker-providers.svg?style=flat-square&maxAge=180
[badge_downloads_count]:https://img.shields.io/packagist/dt/avto-dev/faker-providers.svg?style=flat-square&maxAge=180
[badge_license]:https://img.shields.io/packagist/l/avto-dev/faker-providers.svg?style=flat-square&longCache=true
[badge_release_date]:https://img.shields.io/github/release-date/avto-dev/faker-providers.svg?style=flat-square&maxAge=180
[badge_commits_since_release]:https://img.shields.io/github/commits-since/avto-dev/faker-providers/latest.svg?style=flat-square&maxAge=180
[badge_issues]:https://img.shields.io/github/issues/avto-dev/faker-providers.svg?style=flat-square&maxAge=180
[badge_pulls]:https://img.shields.io/github/issues-pr/avto-dev/faker-providers.svg?style=flat-square&maxAge=180
[link_releases]:https://github.com/avto-dev/faker-providers/releases
[link_packagist]:https://packagist.org/packages/avto-dev/faker-providers
[link_build_status]:https://scrutinizer-ci.com/g/avto-dev/faker-providers/build-status/master
[link_coverage]:https://scrutinizer-ci.com/g/avto-dev/faker-providers/?branch=master
[link_changes_log]:https://github.com/avto-dev/faker-providers/blob/master/CHANGELOG.md
[link_issues]:https://github.com/avto-dev/faker-providers/issues
[link_create_issue]:https://github.com/avto-dev/faker-providers/issues/new/choose
[link_commits]:https://github.com/avto-dev/faker-providers/commits
[link_pulls]:https://github.com/avto-dev/faker-providers/pulls
[link_license]:https://github.com/avto-dev/faker-providers/blob/master/LICENSE
[getcomposer]:https://getcomposer.org/download/
[faker]:https://github.com/fzaninotto/Faker
[identity]:https://github.com/avto-dev/identity-laravel
