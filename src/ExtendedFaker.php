<?php

namespace AvtoDev\FakerProviders;

use LogicException;

/**
 * @mixin \AvtoDev\FakerProviders\Providers\Cars\MarkAndModelProvider
 *
 * @method string carMarkAndModel()
 * @method string carMark()
 * @method string carModel($mark = null)
 * @method string carGeneration()
 *
 * @mixin \AvtoDev\FakerProviders\Providers\Identifiers\BodyProvider
 *
 * @method string bodyCode()
 * @method string validBodyCode()
 * @method string invalidBodyCode()
 *
 * @mixin \AvtoDev\FakerProviders\Providers\Identifiers\ChassisProvider
 *
 * @method string chassisCode()
 * @method string validChassisCode()
 * @method string invalidChassisCode()
 *
 * @mixin \AvtoDev\FakerProviders\Providers\Identifiers\DriverLicenseNumberProvider
 *
 * @method string driverLicenseNumber()
 * @method string validDriverLicenseNumber()
 * @method string invalidDriverLicenseNumber()
 *
 * @mixin \AvtoDev\FakerProviders\Providers\Identifiers\GrzProvider
 *
 * @method string grzCode()
 * @method string validGrzCode()
 * @method string invalidGrzCode()
 *
 * @mixin \AvtoDev\FakerProviders\Providers\Identifiers\PtsProvider
 *
 * @method string ptsCode()
 * @method string validPtsCode()
 * @method string invalidPtsCode()
 *
 * @mixin \AvtoDev\FakerProviders\Providers\Identifiers\StsProvider
 *
 * @method string stsCode()
 * @method string validStsCode()
 * @method string invalidStsCode()
 *
 * @mixin \AvtoDev\FakerProviders\Providers\Identifiers\VinProvider
 *
 * @method string vinCode()
 * @method string validVinCode()
 * @method string invalidVinCode()
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
