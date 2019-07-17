<?php

declare(strict_types = 1);

namespace AvtoDev\FakerProviders\Providers\Identifiers;

/**
 * @property-read string $ptsCode
 * @property-read string $validPtsCode
 * @property-read string $invalidPtsCode
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
    public function ptsCode(...$arguments)
    {
        return $this->validPtsCode(...$arguments);
    }

    /**
     * Generate valid pts code.
     *
     * @param array ...$arguments
     *
     * @return string
     */
    public function validPtsCode(...$arguments)
    {
        return $this->validStsCode(...$arguments);
    }

    /**
     * Generate invalid pts code.
     *
     * @param array ...$arguments
     *
     * @return string
     */
    public function invalidPtsCode(...$arguments)
    {
        return $this->invalidStsCode(...$arguments);
    }
}
