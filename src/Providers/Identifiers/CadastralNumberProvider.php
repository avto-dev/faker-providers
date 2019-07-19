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
        return static::regexify('/^[0-9]{2}:[0-9]{2}:[0-9]{6,7}:[0-9]{1,6}$/');
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
