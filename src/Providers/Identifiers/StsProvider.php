<?php

namespace AvtoDev\FakerProviders\Providers\Identifiers;

/**
 * @property-read string stsCode
 * @property-read string validStsCode
 * @property-read string invalidStsCode
 */
class StsProvider extends AbstractIdentifierProvider
{
    /**
     * Chars that can be used in sts number.
     *
     * @var string[]
     */
    protected static $chars   = [
        'А', 'В', 'Е', 'К', 'М', 'Н', 'О', 'Р', 'С', 'Т', 'Х',
    ];

    /**
     * Allowed formats.
     *
     * @var string[]
     */
    protected static $formats = [
        '## ## ######',
        '## ?? ######',
        '##########',
        '##??######',
    ];

    /**
     * Generate sts code.
     *
     * @param array ...$arguments
     *
     * @return string
     */
    public function stsCode(...$arguments)
    {
        return $this->validStsCode(...$arguments);
    }

    /**
     * Generate valid sts code.
     *
     * @param array ...$arguments
     *
     * @return string
     */
    public function validStsCode(...$arguments)
    {
        return self::bothify(static::randomElement(static::$formats));
    }

    /**
     * Generate invalid sts code.
     *
     * @param array ...$arguments
     *
     * @return string
     */
    public function invalidStsCode(...$arguments)
    {
        $code = '';
        $case = static::numberBetween(0, 1);

        switch ($case) {
            case 0:
                $code = $this->stsCode(...$arguments) . $case;
                break;

            case 1:
                $code = \mb_substr($this->stsCode(...$arguments), 0, -1);
                break;
        }

        return $code;
    }
}
