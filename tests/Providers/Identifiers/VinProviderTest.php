<?php

namespace AvtoDev\FakerProviders\Tests\Providers\Identifiers;

use Closure;
use AvtoDev\IDEntity\IDEntity;
use AvtoDev\FakerProviders\Providers\Identifiers\VinProvider;

class VinProviderTest extends AbstractIdentifierTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function providerClass()
    {
        return VinProvider::class;
    }

    /**
     * {@inheritdoc}
     */
    protected function getValidIdentifier()
    {
        return mt_rand(0, 1) === 1
            ? $this->faker->vinCode
            : $this->faker->vinCode();
    }

    /**
     * {@inheritdoc}
     */
    protected function getInvalidIdentifier()
    {
        return mt_rand(0, 1) === 1
            ? $this->faker->invalidVinCode
            : $this->faker->invalidVinCode();
    }

    /**
     * {@inheritdoc}
     */
    protected function validatorRule()
    {
        return 'string|vin_code';
    }

    /**
     * Get custom validation callback.
     *
     * @return Closure
     */
    protected function validationCallback()
    {
        return function ($identifier) {
            return IDEntity::make($identifier, IDEntity::ID_TYPE_VIN)->isValid();
        };
    }
}
