<?php

namespace AvtoDev\FakerProviders\Tests\Providers\Identifiers;

use Closure;
use AvtoDev\IDEntity\IDEntity;
use AvtoDev\FakerProviders\Providers\Identifiers\ChassisProvider;

class ChassisProviderTest extends AbstractIdentifierTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function providerClass()
    {
        return ChassisProvider::class;
    }

    /**
     * {@inheritdoc}
     */
    protected function getValidIdentifier()
    {
        return mt_rand(0, 1) === 1
            ? $this->faker->chassisCode
            : $this->faker->chassisCode();
    }

    /**
     * {@inheritdoc}
     */
    protected function getInvalidIdentifier()
    {
        return mt_rand(0, 1) === 1
            ? $this->faker->invalidChassisCode
            : $this->faker->invalidChassisCode();
    }

    /**
     * {@inheritdoc}
     */
    protected function validatorRule()
    {
        return 'string|chassis_code';
    }

    /**
     * Get custom validation callback.
     *
     * @return Closure
     */
    protected function validationCallback()
    {
        return function ($identifier) {
            return IDEntity::make($identifier, IDEntity::ID_TYPE_CHASSIS)->isValid();
        };
    }
}
