<?php

declare(strict_types = 1);

namespace AvtoDev\FakerProviders\Tests\Providers\Identifiers;

use Closure;
use AvtoDev\IDEntity\IDEntity;
use AvtoDev\FakerProviders\Providers\Identifiers\CadastralNumberProvider;

/**
 * @covers \AvtoDev\FakerProviders\Providers\Identifiers\CadastralNumberProvider
 */
class CadastralNumberProviderTest extends AbstractIdentifierTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function providerClass(): string
    {
        return CadastralNumberProvider::class;
    }

    /**
     * {@inheritdoc}
     */
    protected function getValidIdentifier(): string
    {
        return \random_int(0, 1) === 1
            ? $this->faker->cadastralNumber
            : $this->faker->cadastralNumber();
    }

    /**
     * {@inheritdoc}
     */
    protected function getInvalidIdentifier(): string
    {
        return \random_int(0, 1) === 1
            ? $this->faker->invalidCadastralNumber
            : $this->faker->invalidCadastralNumber();
    }

    /**
     * {@inheritdoc}
     */
    protected function validatorRule(): string
    {
        return 'string|cadastral_number';
    }

    /**
     * Get custom validation callback.
     *
     * @return Closure
     */
    protected function validationCallback(): Closure
    {
        return static function ($identifier): bool {
            return IDEntity::make($identifier, IDEntity::ID_TYPE_CADASTRAL_NUMBER)->isValid();
        };
    }
}
