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
     * List of available regions.
     *
     * @var array
     */
    protected $regions = [
        91, 66, 50, 30, 20, '09', '01',
    ];

    /**
     * List of available districts.
     *
     * @var array
     */
    protected $districts = [
        '05', '04', '03', '02', '01',
    ];

    /**
     * @return string
     */
    public function cadastralNumber()
    {
        return $this->validCadastralNumber();
    }

    /**
     * Generate valid cadastral number.
     *
     * @return string
     */
    public function validCadastralNumber()
    {
        return \sprintf('%s:%s:%s:%s',
            static::randomElement($this->regions),
            static::randomElement($this->districts),
            static::randomNumber(\mt_rand(6, 7), true),
            static::randomNumber(\mt_rand(1, 6), true)
        );
    }

    /**
     * Generate invalid cadastral number.
     *
     * @return string
     */
    public function invalidCadastralNumber()
    {
        static $invalid_formats = [
            '#:##:######?#:#?#####',
            '#:##:######?#/#?#####',
            '#:##:###:#?#####',
            '###:###:###:###',
        ];

        return self::bothify(static::randomElement($invalid_formats));
    }
}
