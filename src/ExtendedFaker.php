<?php

namespace AvtoDev\FakerProviders;

use LogicException;

/**
 * @mixin \AvtoDev\FakerProviders\Providers\Cars\MarkAndModelProvider
 * @mixin \AvtoDev\FakerProviders\Providers\Identifiers\BodyProvider
 * @mixin \AvtoDev\FakerProviders\Providers\Identifiers\ChassisProvider
 * @mixin \AvtoDev\FakerProviders\Providers\Identifiers\DriverLicenseNumberProvider
 * @mixin \AvtoDev\FakerProviders\Providers\Identifiers\GrzProvider
 * @mixin \AvtoDev\FakerProviders\Providers\Identifiers\PtsProvider
 * @mixin \AvtoDev\FakerProviders\Providers\Identifiers\StsProvider
 * @mixin \AvtoDev\FakerProviders\Providers\Identifiers\VinProvider
 * @mixin \AvtoDev\FakerProviders\Providers\Packages\IDEntityProvider
 * @mixin \AvtoDev\FakerProviders\Providers\User\AvatarUriProvider
 * @mixin \AvtoDev\FakerProviders\Providers\Identifiers\InnAndKppProvider
 */
class ExtendedFaker extends \Faker\Generator
{
    /**
     * ExtendedFaker constructor.
     *
     * @throws LogicException
     */
    public function __construct()
    {
        throw new LogicException('Use this class just for IDE type-hinting');
    }
}
