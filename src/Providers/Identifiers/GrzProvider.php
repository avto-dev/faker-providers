<?php

namespace AvtoDev\FakerProviders\Providers\Identifiers;

use AvtoDev\FakerProviders\Providers\AbstractFakerProvider;

/**
 * @property-read string grzCode
 * @property-read string validGrzCode
 * @property-read string invalidGrzCode
 */
class GrzProvider extends AbstractFakerProvider
{
    /**
     * Allowed formats.
     *
     * @var string[]
     */
    protected static $formats = [
        '?###??reg',
        '####??reg',
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
     * Regions codes.
     *
     * @var string[]|int[]
     */
    protected static $regions = [
        66, 69, 13,
        777, 102, 113,
        '02', '03', '01',
    ];

    /**
     * Generate random GRZ code.
     *
     * @param array ...$arguments
     *
     * @return string
     */
    public function grzCode(...$arguments)
    {
        return $this->validGrzCode(...$arguments);
    }

    /**
     * Generate random GRZ code.
     *
     * @param array ...$arguments
     *
     * @return string
     */
    public function validGrzCode(...$arguments)
    {
        return str_replace(
            'reg',
            static::randomElement(static::$regions),
            self::bothify($this->generator->parse(static::randomElement(static::$formats)))
        );
    }

    /**
     * Generate invalid GRZ code.
     *
     * @param array ...$arguments
     *
     * @return string
     */
    public function invalidGrzCode(...$arguments)
    {
        $code = $this->grzCode(...$arguments);

        switch (static::numberBetween(0, 1)) {
            case 0:
                return mb_substr($code, 0, 2);

            case 1:
                return mb_substr($code, -4);

            default:
                return $code . static::numberBetween(10, 20);
        }
    }
}
