<?php

namespace AvtoDev\FakerProviders\Providers\Identifiers;

/**
 * @property-read string chassisCode
 * @property-read string validChassisCode
 * @property-read string invalidChassisCode
 */
class ChassisProvider extends BodyProvider
{
    /**
     * Generate chassis code.
     *
     * @param array ...$arguments
     *
     * @return string
     */
    public static function chassisCode(...$arguments)
    {
        return static::validChassisCode(...$arguments);
    }

    /**
     * Generate valid chassis code.
     *
     * @param array ...$arguments
     *
     * @return string
     */
    public static function validChassisCode(...$arguments)
    {
        return static::validBodyCode(...$arguments);
    }

    /**
     * Generate invalid chassis code.
     *
     * @param array ...$arguments
     *
     * @return string
     */
    public static function invalidChassisCode(...$arguments)
    {
        return static::invalidBodyCode(...$arguments);
    }
}
