<?php

declare(strict_types = 1);

namespace AvtoDev\FakerProviders\Providers\Identifiers;

/**
 * @property-read string $grzCode
 * @property-read string $validGrzCode
 * @property-read string $invalidGrzCode
 */
class GrzProvider extends AbstractIdentifierProvider
{
    /**
     * Allowed formats.
     *
     * @var string[]
     */
    protected static $formats = [
        '?###??REG',
        '?###??REG_LONG',
        '??###REG',
        '####??REG',
        '??####REG',
        '?####REG',
        '###?REG',
        '####?REG',
    ];

    /**
     * White-list chars for using.
     *
     * @var string[]
     */
    protected static $chars   = [
        'А', 'В', 'Е', 'К', 'М', 'Н', 'О', 'Р', 'С', 'Т', 'У', 'Х',
    ];

    /**
     * Regions codes (2 digits).
     *
     * @var string[]|int[]
     */
    protected static $regions = [
        66, 69, 13, '02', '03', '01', 78, 98, 77, 97, 99, 86, 89, 95, 21, 22
    ];

    /**
     * Regions codes (3 digits).
     *
     * @var string[]|int[]
     */
    protected static $regions_long = [
        777, 102, 113, 102, 111, 112, 113, 116, 716, 121, 123, 124, 125, 126, 197, 199, 799, 178
    ];

    /**
     * Generate random GRZ code.
     *
     * @param array<mixed> ...$arguments
     *
     * @return string
     */
    public function grzCode(...$arguments): string
    {
        return $this->validGrzCode(...$arguments);
    }

    /**
     * Generate random GRZ code.
     *
     * @param array<mixed> ...$arguments
     *
     * @return string
     */
    public function validGrzCode(...$arguments): string
    {
        return \str_replace(
            [
                'REG_LONG',
                'REG',
            ],
            [
                static::randomElement(static::$regions_long),
                static::randomElement(static::$regions),
            ],
            self::bothify(static::randomElement(static::$formats))
        );
    }

    /**
     * Generate invalid GRZ code.
     *
     * @param array<mixed> ...$arguments
     *
     * @return string
     */
    public function invalidGrzCode(...$arguments): string
    {
        $code = $this->grzCode(...$arguments);

        switch (static::numberBetween(0, 2)) {
            case 0:
                return \mb_substr($code, 0, 2);

            case 1:
                return \mb_substr($code, -4);

            default:
                return $code . static::numberBetween(10, 20);
        }
    }
}
