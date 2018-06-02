<?php

namespace AvtoDev\FakerProviders\Providers\Identifiers;

/**
 * @property-read string ptsCode
 * @property-read string validPtsCode
 * @property-read string invalidPtsCode
 */
class PtsProvider extends StsProvider
{
    /**
     * Generate pts code.
     *
     * @param array ...$arguments
     *
     * @return string
     */
    public static function ptsCode(...$arguments)
    {
        return static::validPtsCode(...$arguments);
    }

    /**
     * Generate valid pts code.
     *
     * @param array ...$arguments
     *
     * @return string
     */
    public static function validPtsCode(...$arguments)
    {
        return static::validStsCode(...$arguments);
    }

    /**
     * Generate invalid pts code.
     *
     * @param array ...$arguments
     *
     * @return string
     */
    public static function invalidPtsCode(...$arguments)
    {
        return static::invalidStsCode(...$arguments);
    }
}
