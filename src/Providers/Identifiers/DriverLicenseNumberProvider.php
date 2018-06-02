<?php

namespace AvtoDev\FakerProviders\Providers\Identifiers;

use AvtoDev\FakerProviders\Providers\AbstractFakerProvider;

/**
 * @property-read string driverLicenseNumber
 * @property-read string validDriverLicenseNumber
 * @property-read string invalidDriverLicenseNumber
 */
class DriverLicenseNumberProvider extends AbstractFakerProvider
{
    /**
     * Chars what can be.
     *
     * @var string[]
     */
    protected static $chars   = [
        'А', 'В', 'Е', 'К', 'М', 'Н', 'О', 'Р', 'С', 'Т', 'У', 'Х',
    ];

    /**
     * Regions codes.
     *
     * @var int[]
     */
    protected static $regions = [
        66, 69, 13, 12, 25, 29,
    ];

    /**
     * Generator formats.
     *
     * @var string[]
     */
    protected static $formats = [
        'REG ## ######',
        'REG########',
        'REG ?? ######',
        'REG??######',
    ];

    /**
     * Generate driver license number.
     *
     * @param array ...$arguments
     *
     * @return string
     */
    public function driverLicenseNumber(...$arguments)
    {
        return $this->validDriverLicenseNumber(...$arguments);
    }

    /**
     * Generate valid driver license number.
     *
     * @param array ...$arguments
     *
     * @return string
     */
    public function validDriverLicenseNumber(...$arguments)
    {
        return str_replace(
            'REG',
            static::randomElement(static::$regions),
            self::bothify(static::randomElement(static::$formats))
        );
    }

    /**
     * Generate invalid driver license number.
     *
     * @param array ...$arguments
     *
     * @return string
     */
    public function invalidDriverLicenseNumber(...$arguments)
    {
        static $invalid_formats = [
            '####?#',
            '##??##',
            '??####',
            '###?#--####',
            '##/#?/?#',
        ];

        return self::bothify(static::randomElement($invalid_formats));
    }
}
