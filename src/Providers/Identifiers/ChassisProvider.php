<?php

declare(strict_types = 1);

namespace AvtoDev\FakerProviders\Providers\Identifiers;

/**
 * @property-read string $chassisCode
 * @property-read string $validChassisCode
 * @property-read string $invalidChassisCode
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
    public function chassisCode(...$arguments)
    {
        return $this->validChassisCode(...$arguments);
    }

    /**
     * Generate valid chassis code.
     *
     * @param array ...$arguments
     *
     * @return string
     */
    public function validChassisCode(...$arguments)
    {
        return $this->validBodyCode(...$arguments);
    }

    /**
     * Generate invalid chassis code.
     *
     * @param array ...$arguments
     *
     * @return string
     */
    public function invalidChassisCode(...$arguments)
    {
        return $this->invalidBodyCode(...$arguments);
    }
}
