<?php

declare(strict_types = 1);

namespace AvtoDev\FakerProviders\Tests\Providers\Identifiers;

use Closure;
use AvtoDev\IDEntity\IDEntity;
use AvtoDev\FakerProviders\Providers\Identifiers\PtsProvider;

/**
 * @covers \AvtoDev\FakerProviders\Providers\Identifiers\PtsProvider<extended>
 */
class PtsProviderTest extends AbstractIdentifierTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function providerClass(): string
    {
        return PtsProvider::class;
    }

    /**
     * {@inheritdoc}
     */
    protected function getValidIdentifier(): string
    {
        return \random_int(0, 1) === 1
            ? $this->faker->ptsCode
            : $this->faker->ptsCode();
    }

    /**
     * {@inheritdoc}
     */
    protected function getInvalidIdentifier(): string
    {
        return \random_int(0, 1) === 1
            ? $this->faker->invalidPtsCode
            : $this->faker->invalidPtsCode();
    }

    /**
     * {@inheritdoc}
     */
    protected function validatorRule(): string
    {
        return 'string|pts_code';
    }

    /**
     * Get custom validation callback.
     *
     * @return Closure
     */
    protected function validationCallback(): Closure
    {
        return function ($identifier): bool {
            return IDEntity::make($identifier, IDEntity::ID_TYPE_PTS)->isValid();
        };
    }
}
