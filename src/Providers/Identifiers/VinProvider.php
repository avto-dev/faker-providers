<?php

declare(strict_types = 1);

namespace AvtoDev\FakerProviders\Providers\Identifiers;

/**
 * @property-read string $vinCode
 * @property-read string $validVinCode
 * @property-read string $invalidVinCode
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
    public function vinCode(...$arguments)
    {
        return $this->validVinCode(...$arguments);
    }

    /**
     * Generate vin code.
     *
     * @param array ...$arguments
     *
     * @return string
     */
    public function validVinCode(...$arguments)
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

        switch ($case = $this->numberBetween(0, 1)) {
            case 0:
                $code = \mb_substr($this->vinCode(...$arguments), 0, -1);
                break;

            case 1:
                $code = \substr_replace(
                    $code = $this->vinCode(...$arguments),
                    'I',
                    static::numberBetween(0, mb_strlen($code) - 1),
                    1
                );
                break;
        }

        return $code;
    }
}
