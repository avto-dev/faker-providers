<?php

namespace AvtoDev\FakerProviders\Tests\Providers\Identifiers;

use AvtoDev\FakerProviders\Providers\Identifiers\DriverLicenseNumberProvider;
use AvtoDev\IDEntity\IDEntity;
use Closure;

class DriverLicenseNumberProviderTest extends AbstractIdentifierTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function providerClass()
    {
        return DriverLicenseNumberProvider::class;
    }

    /**
     * {@inheritdoc}
     */
    protected function getValidIdentifier()
    {
        return mt_rand(0, 1) === 1
            ? $this->faker->driverLicenseNumber
            : $this->faker->driverLicenseNumber();
    }

    /**
     * {@inheritdoc}
     */
    protected function getInvalidIdentifier()
    {
        return mt_rand(0, 1) === 1
            ? $this->faker->invalidDriverLicenseNumber
            : $this->faker->invalidDriverLicenseNumber();
    }

    /**
     * {@inheritdoc}
     */
    protected function validatorRule()
    {
        return 'string|driver_license_number';
    }

    /**
     * Get custom validation callback.
     *
     * @return Closure
     */
    protected function validationCallback()
    {
        return function ($identifier) {
            return IDEntity::make($identifier, IDEntity::ID_TYPE_DRIVER_LICENSE_NUMBER)->isValid();
        };
    }
}
