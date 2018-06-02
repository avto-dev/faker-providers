<?php

namespace AvtoDev\FakerProviders\Providers\Identifiers;

/**
 * @property-read string vinCode
 * @property-read string validVinCode
 * @property-read string invalidVinCode
 */
class VinProvider extends AbstractIdentifierProvider
{
    /**
     * White-list chars for using.
     *
     * @var string[]
     */
    protected static $chars   = [
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K',
        'L', 'M', 'N', 'P', 'R', 'S', 'T', 'U', 'V', 'W',
        'X', 'Y', 'Z',
    ];

    /**
     * Allowed formats.
     *
     * @var string[]
     */
    protected static $formats = [
        '*******?*****####',
    ];

    /**
     * Generate vin code.
     *
     * @param array ...$arguments
     *
     * @return string
     */
    public static function vinCode(...$arguments)
    {
        return static::validVinCode(...$arguments);
    }

    /**
     * Generate vin code.
     *
     * @param array ...$arguments
     *
     * @return string
     */
    public static function validVinCode(...$arguments)
    {
        return self::bothify(static::randomElement(static::$formats));
    }

    /**
     * Generate invalid vin code.
     *
     * @param array ...$arguments
     *
     * @return string
     */
    public function invalidVinCode(...$arguments)
    {
        $code = '';
        $case = static::numberBetween(0, 2);

        switch ($case) {
            case 0:
                $code = static::vinCode(...$arguments) . $case;
                break;

            case 1:
                $code = \mb_substr(static::vinCode(...$arguments), 0, -1);
                break;

            case 2:
                $code = \substr_replace(
                    $code = static::vinCode(...$arguments),
                    'I',
                    static::numberBetween(0, mb_strlen($code) - 1),
                    1
                );
                break;
        }

        return $code;
    }
}
