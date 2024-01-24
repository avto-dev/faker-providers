<?php

declare(strict_types = 1);

namespace AvtoDev\FakerProviders\Tests\Providers\Identifiers;

use Closure;
use AvtoDev\IDEntity\IDEntity;
use AvtoDev\FakerProviders\Providers\Identifiers\ChassisProvider;

/**
 * @covers \AvtoDev\FakerProviders\Providers\Identifiers\ChassisProvider
 */
class ChassisProviderTest extends AbstractIdentifierTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function providerClass(): string
    {
        return ChassisProvider::class;
    }

    /**
     * {@inheritdoc}
     */
    protected function getValidIdentifier(): string
    {
        return \random_int(0, 1) === 1
            ? $this->faker->chassisCode
            : $this->faker->chassisCode();
    }

    /**
     * {@inheritdoc}
     */
    protected function getInvalidIdentifier(): string
    {
        return \random_int(0, 1) === 1
            ? $this->faker->invalidChassisCode
            : $this->faker->invalidChassisCode();
    }

    /**
     * {@inheritdoc}
     */
    protected function validatorRule(): string
    {
        return 'string|chassis_code';
    }

    /**
     * Get custom validation callback.
     *
     * @return Closure
     */
    protected function validationCallback(): Closure
    {
        return static function ($identifier): bool {
            return IDEntity::make($identifier, IDEntity::ID_TYPE_CHASSIS)->isValid();
        };
    }
}
