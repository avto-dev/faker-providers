<?php

declare(strict_types = 1);

namespace AvtoDev\FakerProviders\Providers\Identifiers;

/**
 * @property-read string $driverLicenseNumber
 * @property-read string $validDriverLicenseNumber
 * @property-read string $invalidDriverLicenseNumber
 */
class DriverLicenseNumberProvider extends AbstractIdentifierProvider
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
     * @param array<mixed> ...$arguments
     *
     * @return string
     */
    public function driverLicenseNumber(...$arguments): string
    {
        return $this->validDriverLicenseNumber(...$arguments);
    }

    /**
     * Generate valid driver license number.
     *
     * @param array<mixed> ...$arguments
     *
     * @return string
     */
    public function validDriverLicenseNumber(...$arguments): string
    {
        return str_replace(
            'REG',
            (string) static::randomElement(static::$regions),
            self::bothify(static::randomElement(static::$formats))
        );
    }

    /**
     * Generate invalid driver license number.
     *
     * @param array<mixed> ...$arguments
     *
     * @return string
     */
    public function invalidDriverLicenseNumber(...$arguments): string
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
