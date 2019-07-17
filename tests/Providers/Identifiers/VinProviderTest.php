<?php

declare(strict_types = 1);

namespace AvtoDev\FakerProviders\Tests\Providers\Identifiers;

use Closure;
use AvtoDev\IDEntity\IDEntity;
use AvtoDev\FakerProviders\Providers\Identifiers\VinProvider;

/**
 * @covers \AvtoDev\FakerProviders\Providers\Identifiers\VinProvider<extended>
 */
class VinProviderTest extends AbstractIdentifierTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function providerClass(): string
    {
        return VinProvider::class;
    }

    /**
     * {@inheritdoc}
     */
    protected function getValidIdentifier(): string
    {
        return \random_int(0, 1) === 1
            ? $this->faker->vinCode
            : $this->faker->vinCode();
    }

    /**
     * {@inheritdoc}
     */
    protected function getInvalidIdentifier(): string
    {
        return \random_int(0, 1) === 1
            ? $this->faker->invalidVinCode
            : $this->faker->invalidVinCode();
    }

    /**
     * {@inheritdoc}
     */
    protected function validatorRule(): string
    {
        return 'string|vin_code';
    }

    /**
     * Get custom validation callback.
     *
     * @return Closure
     */
    protected function validationCallback(): Closure
    {
        return function ($identifier): bool {
            return IDEntity::make($identifier, IDEntity::ID_TYPE_VIN)->isValid();
        };
    }
}
