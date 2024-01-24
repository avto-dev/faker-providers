<?php

declare(strict_types = 1);

namespace AvtoDev\FakerProviders\Tests\Providers\Identifiers;

use Closure;
use AvtoDev\IDEntity\IDEntity;
use AvtoDev\FakerProviders\Providers\Identifiers\DriverLicenseNumberProvider;

/**
 * @covers \AvtoDev\FakerProviders\Providers\Identifiers\DriverLicenseNumberProvider
 */
class DriverLicenseNumberProviderTest extends AbstractIdentifierTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function providerClass(): string
    {
        return DriverLicenseNumberProvider::class;
    }

    /**
     * {@inheritdoc}
     */
    protected function getValidIdentifier(): string
    {
        return \random_int(0, 1) === 1
            ? $this->faker->driverLicenseNumber
            : $this->faker->driverLicenseNumber();
    }

    /**
     * {@inheritdoc}
     */
    protected function getInvalidIdentifier(): string
    {
        return \random_int(0, 1) === 1
            ? $this->faker->invalidDriverLicenseNumber
            : $this->faker->invalidDriverLicenseNumber();
    }

    /**
     * {@inheritdoc}
     */
    protected function validatorRule(): string
    {
        return 'string|driver_license_number';
    }

    /**
     * Get custom validation callback.
     *
     * @return Closure
     */
    protected function validationCallback(): CLosure
    {
        return static function ($identifier): bool {
            return IDEntity::make($identifier, IDEntity::ID_TYPE_DRIVER_LICENSE_NUMBER)->isValid();
        };
    }
}
