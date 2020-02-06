<?php

declare(strict_types = 1);

namespace AvtoDev\FakerProviders\Providers\Identifiers;

/**
 * @property-read string $bodyCode
 * @property-read string $validBodyCode
 * @property-read string $invalidBodyCode
 */
class BodyProvider extends AbstractIdentifierProvider
{
    /**
     * Chars what can be in body number.
     *
     * @var string[]
     */
    protected static $chars   = [
        // Russian
        'А', 'В', 'С', 'Е', 'К', 'М', 'Н', 'О', 'Р', 'С', 'Т', 'Х',

        // English
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L',
        'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X',
        'Y', 'Z',
    ];

    /**
     * Allowed formats.
     *
     * @var string[]
     */
    protected static $formats = [
        '#######',
        '??##########',
        '???###-#######',
        '???### #######',
        '???*****#####',
    ];

    /**
     * Generate body code.
     *
     * @param array<mixed> ...$arguments
     *
     * @return string
     */
    public function bodyCode(...$arguments): string
    {
        return $this->validBodyCode(...$arguments);
    }

    /**
     * Generate valid body code.
     *
     * @param array<mixed> ...$arguments
     *
     * @return string
     */
    public function validBodyCode(...$arguments): string
    {
        return self::bothify(static::randomElement(static::$formats));
    }

    /**
     * Generate invalid body code.
     *
     * @param array<mixed> ...$arguments
     *
     * @return string
     */
    public function invalidBodyCode(...$arguments): string
    {
        $code = '';
        $case = static::numberBetween(0, 1);

        switch ($case) {
            case 0:
                $code = $this->bodyCode(...$arguments) . \str_repeat((string) $case, 10);
                break;

            case 1:
                $code = \mb_substr($this->bodyCode(...$arguments), 0, 6);
                break;
        }

        return $code;
    }
}
