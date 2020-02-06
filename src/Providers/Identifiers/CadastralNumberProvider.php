<?php

declare(strict_types = 1);

namespace AvtoDev\FakerProviders\Providers\Identifiers;

/**
 * @property-read string $cadastralNumber
 * @property-read string $validCadastralNumber
 * @property-read string $invalidCadastralNumber
 */
class CadastralNumberProvider extends AbstractIdentifierProvider
{
    /**
     * List of available districts.
     *
     * @var array<int>
     */
    protected $districts = [
        91, 66, 50, 30, 20, 9, 1,
    ];

    /**
     * List of available areas.
     *
     * @var array<int>
     */
    protected $areas = [
        1, 2, 3, 4, 5,
    ];

    /**
     * @return string
     */
    public function cadastralNumber(): string
    {
        return $this->validCadastralNumber();
    }

    /**
     * Generate valid cadastral number.
     *
     * @return string
     */
    public function validCadastralNumber(): string
    {
        return \sprintf('%02d:%02d:%07d:%d',
            static::randomElement($this->districts),
            static::randomElement($this->areas),
            static::randomNumber(\random_int(6, 7), true),
            static::randomNumber(\random_int(1, 6), true)
        );
    }

    /**
     * Generate invalid cadastral number.
     *
     * @return string
     */
    public function invalidCadastralNumber(): string
    {
        static $invalid_formats = [
            '#:9##:#######:####',
            '#:##:######?#/#?#####',
            '###:###:###:0',
            '0:###:###:#',
        ];

        return self::bothify(static::randomElement($invalid_formats));
    }
}
