<?php

declare(strict_types = 1);

namespace AvtoDev\FakerProviders\Tests\Providers\Identifiers;

use Closure;
use AvtoDev\IDEntity\IDEntity;
use AvtoDev\FakerProviders\Providers\Identifiers\BodyProvider;

/**
 * @covers \AvtoDev\FakerProviders\Providers\Identifiers\BodyProvider<extended>
 */
class BodyProviderTest extends AbstractIdentifierTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function providerClass(): string
    {
        return BodyProvider::class;
    }

    /**
     * {@inheritdoc}
     */
    protected function getValidIdentifier(): string
    {
        return \random_int(0, 1) === 1
            ? $this->faker->bodyCode
            : $this->faker->bodyCode();
    }

    /**
     * {@inheritdoc}
     */
    protected function getInvalidIdentifier(): string
    {
        return \random_int(0, 1) === 1
            ? $this->faker->invalidBodyCode
            : $this->faker->invalidBodyCode();
    }

    /**
     * {@inheritdoc}
     */
    protected function validatorRule(): string
    {
        return 'string|body_code';
    }

    /**
     * Get custom validation callback.
     *
     * @return Closure
     */
    protected function validationCallback(): Closure
    {
        return function ($identifier): bool {
            return IDEntity::make($identifier, IDEntity::ID_TYPE_BODY)->isValid();
        };
    }
}
